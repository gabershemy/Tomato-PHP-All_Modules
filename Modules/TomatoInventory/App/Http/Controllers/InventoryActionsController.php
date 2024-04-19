<?php

namespace Modules\TomatoInventory\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use ProtoneMedia\Splade\Facades\Toast;
use TomatoPHP\TomatoAdmin\Facade\Tomato;
use Modules\TomatoEcommerce\App\Services\Cart\ProductsServices;
use Modules\TomatoInventory\App\Facades\TomatoInventory;
use Modules\TomatoInventory\App\Import\ImportInventory;
use Modules\TomatoInventory\App\Models\Inventory;
use Modules\TomatoInventory\App\Models\InventoryItem;
use Modules\TomatoInventory\App\Models\InventoryLog;
use Modules\TomatoInventory\App\Models\InventoryReport;
use Modules\TomatoOrders\App\Facades\TomatoOrdering;
use Modules\TomatoBranches\App\Models\Branch;
use Modules\TomatoOrders\App\Models\Order;
use Modules\TomatoProducts\App\Models\Product;

class InventoryActionsController extends Controller
{
    public function status(Request $request, \Modules\TomatoInventory\App\Models\Inventory $model){
        $request->validate([
            'status' => 'required|string|max:255'
        ]);

        $model->status = $request->get('status');
        $model->save();

        TomatoInventory::log($model->id, __('Inventory Movement Has been updated!'), $model->status);

        Toast::success(__('Inventory Movement Has been updated! with status:') . " " . $model->status)->autoDismiss(2);
        return back();
    }

    public function approve(Inventory $model, Request $request)
    {
        $model->status = 'done';
        $model->is_activated = true;
        $model->save();

        foreach ($model->inventoryItems as $item){
            if(!$item->is_activated){
                $product = Product::find($item->item_id);

                if($model->type === 'out'){
                    $check = TomatoInventory::checkBranchInventory(
                        productID: $item->item_id,
                        branchID: $model->branch_id,
                        qty: $item->qty,
                        options: $item->options
                    );
                    if(!$check){
                        Toast::danger(__("Sorry This product out of stock"))->autoDismiss(2);
                        return back();
                    }
                }

                $item->is_activated = true;
                $item->save();

                if($model->is_transaction){
                    TomatoInventory::updateQty(
                        productID: $item->item_id,
                        branchID: $model->branch_id,
                        type: 'out',
                        qty: $item->qty,
                        options: $item->options
                    );

                    TomatoInventory::updateQty(
                        productID: $item->item_id,
                        branchID: $model->to_branch_id,
                        type: 'in',
                        qty: $item->qty,
                        options: $item->options
                    );
                }
                else {
                    TomatoInventory::updateQty(
                        productID: $item->item_id,
                        branchID: $model->branch_id,
                        type: $model->type,
                        qty: $item->qty,
                        options: $item->options
                    );
                }



                TomatoInventory::log(
                    inventroyID: $model->id,
                    log: $product->name . " " . __('moved to inventory') . " " . __('with QTY:') . " " . $item->qty,
                    status: $model->status
                );
            }
        }

        if(setting('ordering_active_inventory')){
            if($model->order_id && $model->order->status === setting('ordering_prepared_status')){
                TomatoOrdering::setOrder($model->order)->withdrew();
                TomatoOrdering::setOrder($model->order)->log(__('Order has been ready on the inventory'));
            }
        }

        TomatoInventory::log($model->id, __('Inventory Movement Has been updated!'), $model->status);

        Toast::success(__('Inventory Movement Has been updated! with status:') . " " . $model->status)->autoDismiss(2);
        return back();
    }

    public function approveItem(InventoryItem $model, Request $request)
    {
        if($model->inventory?->type === 'out'){
            $check = TomatoInventory::checkBranchInventory($model->item_id, $model->inventory?->branch_id, $model->qty, $model->options);
            if(!$check){
                Toast::danger(__("Sorry This product out of stock"))->autoDismiss(2);
                return back();
            }
        }

        $product = Product::find($model->item_id);


        $model->is_activated = true;
        $model->save();

        if($model->is_transaction){
            TomatoInventory::updateQty(
                productID: $model->item_id,
                branchID: $model->inventory?->branch_id,
                type: 'out',
                qty: $model->qty,
                options: $model->options
            );

            TomatoInventory::updateQty(
                productID: $model->item_id,
                branchID: $model->inventory?->branch_id,
                type: 'in',
                qty: $model->qty,
                options: $model->options
            );
        }
        else {
            TomatoInventory::updateQty(
                productID: $model->item_id,
                branchID: $model->inventory?->branch_id,
                type: $model->inventory?->type,
                qty: $model->qty,
                options: $model->options
            );
        }



        TomatoInventory::log(
            inventroyID: $model->inventory?->id,
            log: $product->name . " " . __('moved to inventory') . " " . __('with QTY:') . " " . $model->qty,
            status: $model->inventory?->status
        );

        TomatoInventory::log(
            $model->inventory?->id,
            __('Inventory Item Has been updated!'),
             $model->inventory?->status,
        );

        Toast::success(__('Inventory Item Has been updated! with status:') . " " . $model->inventory->status)->autoDismiss(2);
        return back();
    }

    public function barcodes(){
        return view('tomato-inventory::inventories.barcode');
    }

    public function barcodesPrint(Request $request){
        $request->validate([
            "product_id" => "required|array",
            "product_id*id" => "required|exists:products,id",
            "options" => "nullable|array",
            "qty" => "required|numeric|min:1"
        ]);

        $options = "";
        if($request->get('options') && count($request->get('options'))){
            foreach ($request->get('options') as $key=>$option) {
                $options.= $option.'-';
            }
        }
        $product= Product::find($request->get('product_id')['id']);

        if($product){
            $price = ProductsServices::getProductPrice($product->id, $request->get('options'));
            $barcode = $product->sku . '-'.$options.$price->collect();
            return view('tomato-inventory::inventories.barcode-print', [
                "barcode" => $product->barcode,
                "text" => $barcode,
                "qty" => $request->get('qty')
            ]);
        }
        else {
            return back();
        }
    }

    public function report(){
        return view('tomato-inventory::inventories.report');
    }

    public function reportData(Request $request){
        $request->validate([
            "branch_id" => "nullable|exists:branches,id",
            "product_id" => "nullable|array",
            "options" => "nullable|array"
        ]);

        $report = InventoryReport::query();
        $report->with('branch');

        if($request->has('branch_id') && !empty($request->get('branch_id'))){
            $report->where('branch_id', $request->get('branch_id'));
        }
        if($request->has('product_id') && isset($request->get('product_id')['id']) && $request->get('product_id') !=='undefined'){
            $report->where('item_id', $request->get('product_id')['id'])
                ->where('item_type', Product::class);
        }

        $report = $report->get()->map(function ($item){
            $item->product  = $item->item_type::find($item->item_id);
            return $item;
        }) ?? [];


        if($report){
            return response()->json([
                "data" => $report,
            ]);
        }
    }

    public function import(){
        return view('tomato-inventory::inventories.import');
    }


    public function importStore(Request $request)
    {
        $request->validate([
            "file" => "required|file|mimes:xlsx,doc,docx,ppt,pptx,ods,odt,odp",
            'uuid' => 'required|unique:inventories,uuid',
            'branch_id' => 'required|exists:branches,id',
            'type' => 'required|max:255|string'
        ]);

        $collection = Excel::toArray(new ImportInventory(), $request->file('file'));
        unset($collection[0][0]);
        $branch = Branch::find($request->get('branch_id'));
        if($branch){
            DB::beginTransaction();
            $inventory = Inventory::create([
                "branch_id" => $branch->id,
                "company_id" => $branch->company_id,
                "user_id" => auth('web')->user()->id,
                "uuid" => $request->get('uuid'),
                "type" => $request->get('type'),
                "status" => "pending",
                "is_activated" => false
            ]);

            if($inventory){
                $total = 0;
                $discount = 0;
                $vat = 0;
                foreach ($collection[0] as $item){
                    $product = Product::where('sku', $item[0])->first();
                    $options = [];
                    if($product){
                        if($product->has_options){
                            $productOptions = $product->productMetas()->where('key', 'options')->first()?->value;
                            $inventoryOptions = explode(',', $item[2]);
                            foreach ($productOptions as $key=>$option){
                                $checkItem = array_intersect($option, $inventoryOptions);
                                if(count($checkItem) >= 1){
                                    $moveToCollection = collect($checkItem);
                                    $options[$key] = $moveToCollection->first();
                                }
                                else {
                                    DB::rollBack();

                                    Toast::danger(__('Some Options on the file not correct please try again'))->autoDismiss(2);
                                    return back();
                                }
                            }
                        }

                        $inventory->inventoryItems()->create([
                            'item_id' => $product->id??null,
                            'item_type' => Product::class??null,
                            'item' => $product->name,
                            'qty' => $item[1],
                            'price' => $product->price,
                            'discount' => $product->discount,
                            'tax' => $product->vat,
                            'total' => (($product->price+$product->vat)-$product->discount)* $item[1],
                            'options' => $options,
                        ]);

                        $total+= (($product->price+$product->vat)-$product->discount)* $item[1];
                        $discount+= $product->discount;
                        $vat+= $product->vat;
                    }
                }

                $inventory->total = $total;
                $inventory->discount = $discount;
                $inventory->vat =$vat;
                $inventory->save();
            }
            DB::commit();
        }



        Toast::success(__('Your File Has Been Imported Successfully'))->autoDismiss(2);
        return back();
    }

    public function printIndex(Request $request){
        $query = Inventory::query();
        if($request->has('history') && $request->get('history')){
            $query->where('is_activated', 1);
        }
        else {
            $query->where('is_activated', 0);
        }
        $inventory = $query->with('inventoryItems')->get();
        return view('tomato-inventory::inventories.print', [
            'inventory' => $inventory
        ]);
    }
}
