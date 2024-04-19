<?php

namespace Modules\TomatoInventory\App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Modules\TomatoBranches\App\Models\Branch;
use Modules\TomatoBranches\App\Models\Company;
use Modules\TomatoOrders\App\Models\Order;

/**
 * @property integer $id
 * @property integer $company_id
 * @property integer $user_id
 * @property integer $branch_id
 * @property integer $to_branch_id
 * @property integer $order_id
 * @property string $type
 * @property string $status
 * @property string $notes
 * @property boolean $is_activated
 * @property boolean $is_paid
 * @property boolean $is_transaction
 * @property float $vat
 * @property float $discount
 * @property float $total
 * @property string $created_at
 * @property string $updated_at
 * @property Branch $branch
 * @property Company $company
 * @property Order $order
 * @property Branch $toBranch
 * @property User $user
 * @property InventoryItem[] $inventoryItems
 * @property InventoryMeta[] $inventoryMetas
 */
class Inventory extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['uuid','company_id', 'user_id', 'branch_id', 'to_branch_id', 'order_id', 'type', 'status', 'notes', 'is_activated', 'is_paid', 'is_transaction', 'vat', 'discount', 'total', 'created_at', 'updated_at'];


    protected $casts = [
        "is_activated" => "boolean",
        "is_paid" => "boolean",
        "is_transaction" => "boolean"
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function toBranch()
    {
        return $this->belongsTo(Branch::class, 'to_branch_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function inventoryItems()
    {
        return $this->hasMany('Modules\TomatoInventory\App\Models\InventoryItem');
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function inventoryMetas()
    {
        return $this->hasMany('Modules\TomatoInventory\App\Models\InventoryMeta');
    }


    /**
     * @param string $key
     * @param string|null $value
     * @return mixed
     */
    public function meta(string $key, mixed $value=null): mixed
    {
        if($value !== null){
            return $this->inventoryMetas()->updateOrCreate(['key' => $key], ['value' => $value]);
        }
        else {
            return $this->inventoryMetas()->where('key', $key)->first()?->value ?? null;
        }
    }

    public function logs(){
        return $this->hasMany(InventoryLog::class);
    }
}
