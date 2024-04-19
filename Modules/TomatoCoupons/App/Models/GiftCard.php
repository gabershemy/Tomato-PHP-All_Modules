<?php

namespace Modules\TomatoCoupons\App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $account_id
 * @property string $name
 * @property string $code
 * @property float $balance
 * @property string $currency
 * @property boolean $is_activated
 * @property boolean $is_expired
 * @property string $created_at
 * @property string $updated_at
 * @property Account $account
 */
class GiftCard extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['account_id', 'name', 'code', 'balance', 'currency', 'is_activated', 'is_expired', 'created_at', 'updated_at'];

    protected $casts = [
        'is_activated' => "boolean",
        "is_expired" => "boolean"
    ];
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function account()
    {
        return $this->belongsTo(config('tomato-crm.model'));
    }
}
