<?php

namespace Modules\TomatoOrders\App\Services\Traits;

use Illuminate\Http\Request;
use Modules\TomatoInventory\App\Facades\TomatoInventory;
use Modules\TomatoOrders\App\Models\Order;
use Modules\TomatoProducts\App\Models\Product;

trait StatusUpdate
{
    public function status(string $status): string|bool
    {
        if(setting('ordering_active_inventory') && $status === setting('ordering_prepared_status')) {
            $checkInventory = $this->inventoryAction();
            if(is_string($checkInventory)){
                return $checkInventory;
            }
            else {
                $this->order->status = $status;
                $this->order->save();

                $this->log(__("Status changed to") . " " . $status);

                return true;
            }
        }
        else {
            $this->order->status = $status;
            $this->order->save();

            $this->log(__("Status changed to") . " " . $status);

            return true;
        }


    }

    public function inventoryAction(): string|bool
    {
        $checkInventory = $this->checkInventory($this->order->ordersItems()->get()->map(function ($item){
            $item->item = Product::find($item->product_id)->toArray();
            return $item;
        })->toArray());
        if($checkInventory === 'success') {
            TomatoInventory::orderToInventory($this->order);

            return true;
        }
        else {
            $message = __('Product With SKU') .':'. $checkInventory .' ' . __("is out of stock we can not prepare this order");
            $this->log($message);

            return $message;
        }
    }

    public function pending(): void
    {
        $this->status(setting('ordering_pending_status'));
    }

    public function prepared(): void
    {
        $this->status(setting('ordering_prepared_status'));
    }

    public function withdrew(): void
    {
        $this->status(setting('ordering_withdrew_status'));
    }

    public function shipped(): void
    {
        $this->status(setting('ordering_shipped_status'));
    }

    public function delivered(): void
    {
        $this->status(setting('ordering_delivered_status'));
    }

    public function cancel(): void
    {
        $this->status(setting('ordering_cancelled_status'));
    }

    public function refunded(): void
    {
        $this->status(setting('ordering_refunded_status'));
    }

    public function done(): void
    {
        $this->status(setting('ordering_done_status'));
    }

    public function paid(): void
    {
        $this->status(setting('ordering_paid_status'));
    }

    public function approve(): bool|string
    {
        if(setting('ordering_active_inventory')) {
            $checkInventory = $this->inventoryAction();
            if(is_string($checkInventory)){
                return $checkInventory;
            }
            else {
                $this->order->is_approved = true;
                $this->order->save();

                $this->log(__("Order Has Been Approved"));

                $this->prepared();

                return true;
            }

        }
        else {
            $this->order->is_approved = true;
            $this->order->save();

            $this->log(__("Order Has Been Approved"));

            $this->prepared();

            return true;
        }

    }
}
