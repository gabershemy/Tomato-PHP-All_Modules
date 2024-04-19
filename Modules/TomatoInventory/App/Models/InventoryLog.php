<?php

namespace Modules\TomatoInventory\App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Kirschbaum\PowerJoins\PowerJoins;

/**
 * @property integer $id
 * @property integer $user_id
 * @property integer $inventory_id
 * @property string $status
 * @property string $note
 * @property boolean $is_closed
 * @property string $created_at
 * @property string $updated_at
 * @property Inventory $inventory
 * @property User $user
 */
class InventoryLog extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['user_id', 'inventory_id', 'status', 'note', 'is_closed', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function inventory()
    {
        return $this->belongsTo('Modules\TomatoInventory\App\Models\Inventory');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
