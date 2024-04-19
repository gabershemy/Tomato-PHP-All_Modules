<?php

namespace Modules\TomatoInventory\App\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\TomatoBranches\App\Models\Branch;

/**
 * @property integer $id
 * @property integer $branch_id
 * @property string $item_type
 * @property integer $item_id
 * @property float $qty
 * @property mixed $options
 * @property boolean $is_activated
 * @property string $created_at
 * @property string $updated_at
 * @property Branch $branch
 */
class InventoryReport extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['branch_id', 'item_type', 'item_id', 'qty', 'options','is_activated', 'created_at', 'updated_at'];

    protected $casts = [
        "options" => "json",
        "is_activated" => "boolean"
    ];
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
}
