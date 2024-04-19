<?php

namespace Modules\TomatoOrders\App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Modules\TomatoBranches\App\Models\Branch;
use Modules\TomatoCoupons\App\Models\Coupon;
use Modules\TomatoCrm\App\Models\Location;
use Modules\TomatoLocations\App\Models\Area;
use Modules\TomatoLocations\App\Models\City;
use Modules\TomatoLocations\App\Models\Country;

/**
 * @property integer $id
 * @property integer $user_id
 * @property integer $country_id
 * @property integer $area_id
 * @property integer $city_id
 * @property integer $address_id
 * @property integer $account_id
 * @property integer $cashier_id
 * @property integer $coupon_id
 * @property integer $shipper_id
 * @property integer $shipping_vendor_id
 * @property integer $branch_id
 * @property string $uuid
 * @property string $type
 * @property string $name
 * @property string $phone
 * @property string $flat
 * @property string $address
 * @property string $source
 * @property string $shipper_vendor
 * @property float $total
 * @property float $discount
 * @property float $shipping
 * @property float $vat
 * @property string $status
 * @property boolean $is_approved
 * @property boolean $is_closed
 * @property boolean $is_on_table
 * @property string $table
 * @property string $notes
 * @property boolean $has_returns
 * @property float $return_total
 * @property string $reason
 * @property boolean $is_payed
 * @property string $payment_method
 * @property string $payment_vendor
 * @property string $payment_vendor_id
 * @property string $created_at
 * @property string $updated_at
 * @property Invoice[] $invoices
 * @property OrderLog[] $orderLogs
 * @property OrderMeta[] $orderMetas
 * @property Account $customer
 * @property Location $location
 * @property Area $area
 * @property Branch $branch
 * @property User $user
 * @property City $city
 * @property Country $country
 * @property Coupon $coupon
 * @property Delivery $delivery
 * @property ShippingVendor $shippingVendor
 * @property User $cashier
 * @property OrdersItem[] $ordersItems
 */
class Order extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['user_id', 'country_id', 'area_id', 'city_id', 'address_id', 'account_id', 'cashier_id', 'coupon_id', 'shipper_id', 'shipping_vendor_id', 'branch_id', 'uuid', 'type', 'name', 'phone', 'flat', 'address', 'source', 'shipper_vendor', 'total', 'discount', 'shipping', 'vat', 'status', 'is_approved', 'is_closed', 'is_on_table', 'table', 'notes', 'has_returns', 'return_total', 'reason', 'is_payed', 'payment_method', 'payment_vendor', 'payment_vendor_id', 'created_at', 'updated_at'];

    protected $casts = [
        'is_approved' => 'bool',
        'is_closed' => 'bool',
        'is_on_table' => 'bool',
        'has_returns' => 'bool',
        'is_payed' => 'bool',
    ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orderLogs()
    {
        return $this->hasMany('Modules\TomatoOrders\App\Models\OrderLog');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orderMetas()
    {
        return $this->hasMany('Modules\TomatoOrders\App\Models\OrderMeta');
    }

    /**
     * @param string $key
     * @param string|null $value
     * @return Model|string
     */
    public function meta(string $key, mixed $value=null): mixed
    {
        if($value){
            return $this->orderMetas()->updateOrCreate(['key' => $key], ['value' => $value]);
        }
        else {
            return $this->orderMetas()->where('key', $key)->first()?->value;
        }
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function account()
    {
        return $this->belongsTo(config('tomato-crm.model'), 'account_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function location()
    {
        return $this->belongsTo(Location::class, 'address_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function area()
    {
        return $this->belongsTo(Area::class);
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
    public function cashier()
    {
        return $this->belongsTo(User::class, 'cashier_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function city()
    {
        return $this->belongsTo(City::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function coupon()
    {
        return $this->belongsTo(Coupon::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function delivery()
    {
        return $this->belongsTo('Modules\TomatoOrders\App\Models\Delivery', 'shipper_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function shippingVendor()
    {
        return $this->belongsTo('Modules\TomatoOrders\App\Models\ShippingVendor');
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
    public function ordersItems()
    {
        return $this->hasMany('Modules\TomatoOrders\App\Models\OrdersItem');
    }
}
