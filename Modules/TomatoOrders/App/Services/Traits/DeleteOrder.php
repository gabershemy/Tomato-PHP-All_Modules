<?php

namespace Modules\TomatoOrders\App\Services\Traits;

use Illuminate\Http\Request;
use Modules\TomatoOrders\App\Models\Order;

trait DeleteOrder
{
    public function delete(): void
    {
        $this->order->ordersItems()->delete();
        $this->order->delete();
    }
}
