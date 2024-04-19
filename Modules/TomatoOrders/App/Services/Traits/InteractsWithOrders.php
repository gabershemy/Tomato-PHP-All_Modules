<?php

namespace Modules\TomatoOrders\App\Services\Traits;

use Modules\TomatoOrders\App\Models\Order;

trait InteractsWithOrders
{
    public function orders(){
        return $this->hasMany(Order::class);
    }
}
