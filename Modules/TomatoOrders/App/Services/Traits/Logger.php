<?php

namespace Modules\TomatoOrders\App\Services\Traits;

use Modules\TomatoOrders\App\Models\OrderLog;

trait Logger
{
    public function log(string $log): void
    {
        $newLog = new OrderLog();
        if(auth('web')->user()){
            $newLog->user_id = auth('web')->user()->id;
        }
        $newLog->order_id = $this->order->id;
        $newLog->status = $this->order->status;
        $newLog->note = $log;
        $newLog->save();
    }
}
