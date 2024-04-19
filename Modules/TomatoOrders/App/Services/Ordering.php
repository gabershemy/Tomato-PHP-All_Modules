<?php

namespace Modules\TomatoOrders\App\Services;

use Modules\TomatoOrders\App\Models\Order;
use Modules\TomatoOrders\App\Services\Traits\CheckBalance;
use Modules\TomatoOrders\App\Services\Traits\DeleteOrder;
use Modules\TomatoOrders\App\Services\Traits\FindOrder;
use Modules\TomatoOrders\App\Services\Traits\GenerateUUID;
use Modules\TomatoOrders\App\Services\Traits\GetShippingPrice;
use Modules\TomatoOrders\App\Services\Traits\HandleRequest;
use Modules\TomatoOrders\App\Services\Traits\InventoryCheck;
use Modules\TomatoOrders\App\Services\Traits\Logger;
use Modules\TomatoOrders\App\Services\Traits\Shipping;
use Modules\TomatoOrders\App\Services\Traits\StatusUpdate;
use Modules\TomatoOrders\App\Services\Traits\StoreOrder;
use Modules\TomatoOrders\App\Services\Traits\StoreWebOrder;
use Modules\TomatoOrders\App\Services\Traits\SyncCart;
use Modules\TomatoOrders\App\Services\Traits\SyncItems;
use Modules\TomatoOrders\App\Services\Traits\SyncMeta;
use Modules\TomatoOrders\App\Services\Traits\UpdateAccountMeta;
use Modules\TomatoOrders\App\Services\Traits\UpdateOrder;
use Modules\TomatoOrders\App\Services\Traits\ValidateOrder;

class Ordering
{
    use GenerateUUID;
    use Logger;
    use HandleRequest;
    use ValidateOrder;
    use InventoryCheck;
    use SyncCart;
    use SyncItems;
    use SyncMeta;
    use StoreOrder;
    use UpdateAccountMeta;
    use GetShippingPrice;
    use CheckBalance;
    use StoreWebOrder;
    use Shipping;
    use UpdateOrder;
    use StatusUpdate;
    use DeleteOrder;
    use FindOrder;

    private Order $order;

    public function __construct()
    {
        $this->order = new Order();
    }

    public function setOrder(Order $order): self
    {
        $this->order = $order;
        return $this;
    }
}
