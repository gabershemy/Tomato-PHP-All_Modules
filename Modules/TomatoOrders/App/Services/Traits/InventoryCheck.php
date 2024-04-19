<?php

namespace Modules\TomatoOrders\App\Services\Traits;

use Illuminate\Http\Request;
use Modules\TomatoInventory\App\Facades\TomatoInventory;

trait InventoryCheck
{
    public function checkInventory(array $items): string
    {
        foreach ($items as $item){
            $checkQTY = TomatoInventory::checkBranchInventory(
                productID: $item['item']['id'],
                branchID: setting('ordering_active_inventory_direct_branch'),
                qty: $item['qty'],
                options: $item['options'] ?? []
            );

            if(!$checkQTY){
                return $item['item']['sku'];
            }
        }

        return "success";
    }
}
