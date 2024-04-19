<?php

namespace Modules\TomatoInventory\App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $inventory_id
 * @property string $type
 * @property string $item_type
 * @property integer $item_id
 * @property string $linked_type
 * @property integer $linked_id
 * @property string $item
 * @property string $description
 * @property string $note
 * @property float $qty
 * @property float $price
 * @property float $discount
 * @property float $tax
 * @property float $total
 * @property mixed $options
 * @property boolean $is_activated
 * @property string $created_at
 * @property string $updated_at
 * @property Inventory $inventory
 */
class InventoryItem extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['uuid','inventory_id', 'type', 'item_type', 'item_id', 'linked_type', 'linked_id', 'item', 'description', 'note', 'qty', 'price', 'discount', 'tax', 'total', 'options', 'is_activated', 'created_at', 'updated_at'];

    protected $casts = [
        "options" => "json",
        "is_activated" => "boolean"
    ];
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function inventory()
    {
        return $this->belongsTo('Modules\TomatoInventory\App\Models\Inventory');
    }
}
