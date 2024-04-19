<?php

namespace Modules\TomatoInventory\App\Facades;

use Illuminate\Support\Facades\Facade;
use Modules\TomatoOrders\App\Models\Branch;
use Modules\TomatoOrders\App\Models\Order;

/**
 * @method static bool|float checkProductInventory(int $productID, float $qty, array $options = [], bool $isQty = false)
 * @method static bool|float checkBranchInventory(int $productID,int $branchID, float $qty, array $options = [], bool $isQty = false)
 * @method static bool checkInventoryItemQty(int $productID,int $branchID, float $qty,array $options=[], int $ignore=null)
 * @method static void log(int $inventroyID, string $log,string $status='pending')
 * @method static void updateQty(int $productID,int $branchID,string $type, float $qty,array $options=[])
 * @method static void orderToInventory(Order $order, bool $paid=false)
 */
class TomatoInventory extends Facade
{
    public static function getFacadeAccessor()
    {
        return 'tomato-inventory';
    }
}
