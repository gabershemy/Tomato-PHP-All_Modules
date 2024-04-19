<?php

namespace Modules\TomatoInventory\App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $refund_id
 * @property string $key
 * @property mixed $value
 * @property string $type
 * @property string $group
 * @property string $created_at
 * @property string $updated_at
 * @property Refund $refund
 */
class RefundMeta extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['refund_id', 'key', 'value', 'type', 'group', 'created_at', 'updated_at'];

    protected $casts = [
        "value" => "json"
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function refund()
    {
        return $this->belongsTo('Modules\TomatoInventory\App\Models\Refund');
    }
}
