<?php

namespace Modules\TomatoInventory\App\Services;

use Illuminate\Support\Str;
use Modules\TomatoInventory\App\Facades\TomatoInventory;
use Modules\TomatoInventory\App\Models\InventoryItem;
use Modules\TomatoInventory\App\Models\InventoryLog;
use Modules\TomatoInventory\App\Models\InventoryReport;
use Modules\TomatoBranches\App\Models\Branch;
use Modules\TomatoOrders\App\Models\Order;
use Modules\TomatoProducts\App\Models\Product;

class Inventory
{
    public function checkProductInventory(int $productID,float $qty,array $options=[], bool $isQty=false): bool|float
    {
        $product = Product::find($productID);
        if($product){
            if(count($options)){
                if($product->meta('qty')){
                    foreach($product->meta('qty') as $key=>$item){
                        if(Str::of($key)->containsAll(array_merge($options, ['qty']))){
                            if((float)$item >= $qty){
                                if($isQty){
                                    return (float)$item;
                                }
                                else {
                                    return true;
                                }
                            }
                        }
                    }
                }
            }

            if($product->has_unlimited_stock){
                if($isQty){
                    return 1000000000.00;
                }
                else {
                    return true;
                }
            }

            if((float)$product->meta('stock') >= $qty){
                if($isQty){
                    return (float)$product->meta('stock');
                }
                else {
                    return true;
                }
            }
        }

        if($isQty){
            return 0;
        }
        else {
            return false;
        }

    }

    public function checkBranchInventory(int $productID,int $branchID, float $qty,array $options=[], bool $isQty=false): bool|float
    {
        $inventoryReport = InventoryReport::query();
        $inventoryReport->where('item_type', Product::class);
        $inventoryReport->where('item_id', $productID);
        $inventoryReport->where('branch_id', $branchID);
        if(count($options)){
            $inventoryReport->whereJsonContains('options', $options ?? null);
        }
        $inventoryReport = $inventoryReport->first();

        if($inventoryReport){
            if($isQty){
                return $inventoryReport->qty;
            }
            else {
                if($inventoryReport->qty >= $qty){
                    return true;
                }
                else {
                    return false;
                }
            }
        }

        if($isQty){
            return 0;
        }
        else {
            return false;
        }
    }

    public function checkInventoryItemQty(int $productID,int $branchID, float $qty,array $options=[],int $ignore=null): bool
    {
        $inventoryItem = InventoryItem::query();
        $inventoryItem->where('item_type', Product::class);
        $inventoryItem->where('item_id', $productID);
        $inventoryItem->whereHas('inventory', function ($q) use ($branchID, $ignore){
            if($ignore){
                $q->where('branch_id', $branchID)->where('is_activated', 0)->where('id', '!=', $ignore);
            }
            else {
                $q->where('branch_id', $branchID)->where('is_activated', 0);
            }

        });
        $inventoryItem->whereJsonContains('options', $options);
        $items = $inventoryItem->get();
        $total  = 0;
        foreach ($items as $item){
            $total += $item->qty;
        }
        $getQtyOnStock = $this->checkBranchInventory($productID, $branchID, $qty, $options, true);

        if($total >= $getQtyOnStock){
            return false;
        }
        else {
            return true;
        }
    }

    public function log(int $inventroyID, string $log,string $status='pending'): void
    {
        $newLog = new InventoryLog();
        $newLog->user_id = auth('web')->user()->id;
        $newLog->inventory_id = $inventroyID;
        $newLog->status = $status;
        $newLog->note = $log;
        $newLog->save();
    }

    public function updateQty(int $productID,int $branchID,string $type, float $qty,array $options=[]): void
    {
        $checkReport = InventoryReport::where('branch_id', $branchID)
            ->where('item_type', Product::class)
            ->where('item_id', $productID)
            ->whereJsonContains('options', $options)->first();

        if($checkReport){
            if($type === 'in'){
                $checkReport->qty += $qty;
            }
            else {
                $checkReport->qty -= $qty;
            }

            $checkReport->save();
        }
        else {
            $report = new InventoryReport();
            $report->branch_id = $branchID;
            $report->item_type = Product::class;
            $report->item_id = $productID;
            $report->options = $options;
            $report->qty = $qty;
            $report->save();
        }
    }

    public function orderToInventory(Order $order, bool $paid=false): void
    {
        $exists = \Modules\TomatoInventory\App\Models\Inventory::where('uuid', "ORDER-".$order->uuid)->first();
        if(!$exists){
            if($order->source === 'direct'){
                $branch = Branch::find(setting('ordering_active_inventory_direct_branch'));
            }
            else {
                $branch = Branch::find(setting('ordering_active_inventory_web_branch'));
            }
            $inventory = new \Modules\TomatoInventory\App\Models\Inventory();
            $inventory->uuid = "ORDER-".$order->uuid;
            $inventory->company_id = $branch->company_id;
            $inventory->branch_id = $branch->id;
            $inventory->user_id = auth('web')->user()->id;
            $inventory->type = 'out';
            $inventory->order_id = $order->id;
            if($paid){
                $inventory->status = 'done';
            }
            else {
                $inventory->status = 'pending';
            }

            $inventory->total = $order->total;
            $inventory->vat = $order->vat;
            $inventory->discount = $order->discount;
            $inventory->notes = $order->notes;
            if($paid){
                $inventory->is_activated = true;
            }
            else {
                $inventory->is_activated = false;
            }

            $inventory->save();

            foreach ($order->ordersItems as $item){
                if($paid){
                    $is_activated = true;
                }
                else {
                    $is_activated = false;
                }

                $inventory->inventoryItems()->create([
                    'uuid' => $inventory->uuid . '-' . Str::random(6) . '-' . $order->uuid,
                    'item_id' => $item->product_id,
                    'item_type' => Product::class,
                    'item' => $item->product?->name,
                    'qty' => $item->qty,
                    'price' => $item->price,
                    'discount' => $item->discount,
                    'tax' => $item->tax,
                    'total' => $item->total,
                    'options' => $item->options ?? [],
                    "is_activated" => $is_activated
                ]);


                if($paid){
                    $this->updateQty(
                        $item->product_id,
                        $branch->id,
                        'out',
                        $item->qty,
                            $item->options ?? []
                    );

                    $this->log($inventory->id, "Order #".$order->uuid." has been paid so it's done now");
                }
            };
        }


    }
}
