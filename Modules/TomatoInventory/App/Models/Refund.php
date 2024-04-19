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
 * @property integer $order_id
 * @property string $status
 * @property string $notes
 * @property boolean $is_activated
 * @property float $vat
 * @property float $discount
 * @property float $total
 * @property string $created_at
 * @property string $updated_at
 * @property RefundItem[] $refundItems
 * @property RefundMeta[] $refundMetas
 * @property Branch $branch
 * @property Company $company
 * @property Order $order
 * @property User $user
 */
class Refund extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['company_id', 'user_id', 'branch_id', 'order_id', 'status', 'notes', 'is_activated', 'vat', 'discount', 'total', 'created_at', 'updated_at'];

    protected $casts = [
        "is_activated" => "boolean"
    ];
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function refundItems()
    {
        return $this->hasMany('Modules\TomatoInventory\App\Models\RefundItem');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function refundMetas()
    {
        return $this->hasMany('Modules\TomatoInventory\App\Models\RefundMeta');
    }

    /**
     * @param string $key
     * @param string|null $value
     * @return mixed
     */
    public function meta(string $key, mixed $value=null): mixed
    {
        if($value !== null){
            return $this->refundMetas()->updateOrCreate(['key' => $key], ['value' => $value]);
        }
        else {
            return $this->refundMetas()->where('key', $key)->first()?->value ?? null;
        }
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function branch()
    {
        return $this->belongsTo(Branch::class);
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
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
