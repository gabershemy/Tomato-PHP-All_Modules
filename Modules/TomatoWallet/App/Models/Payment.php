<?php

namespace Modules\TomatoWallet\App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $payment_status_id
 * @property string $uuid
 * @property integer $model_id
 * @property string $model_table
 * @property integer $order_id
 * @property string $order_table
 * @property string $type
 * @property string $payment_method
 * @property string $transaction_vendor
 * @property string $transaction_code
 * @property float $amount
 * @property string $notes
 * @property string $currency
 * @property string $created_at
 * @property string $updated_at
 * @property PaymentStatus $paymentStatus
 */
class Payment extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['payment_status_id', 'uuid', 'model_id', 'model_table', 'order_id', 'order_table', 'type', 'payment_method', 'transaction_vendor', 'transaction_code', 'amount', 'notes', 'currency', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function paymentStatus()
    {
        return $this->belongsTo('Modules\TomatoWallet\App\Models\PaymentStatus');
    }


}
