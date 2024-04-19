<?php

namespace Modules\TomatoWallet\App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property boolean $status
 * @property mixed $payload
 * @property mixed $response
 * @property string $created_at
 * @property string $updated_at
 */
class PaymentLog extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['status', 'payload', 'response', 'created_at', 'updated_at'];
}
