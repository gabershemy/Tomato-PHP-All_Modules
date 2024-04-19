<?php

namespace Modules\TomatoOrders\App\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\TomatoLocations\App\Models\Area;
use Modules\TomatoLocations\App\Models\City;
use Modules\TomatoLocations\App\Models\Country;

/**
 * @property integer $id
 * @property integer $shipping_vendor_id
 * @property integer $delivery_id
 * @property integer $country_id
 * @property integer $city_id
 * @property integer $area_id
 * @property string $type
 * @property float $price
 * @property string $created_at
 * @property string $updated_at
 * @property Area $area
 * @property City $city
 * @property Country $country
 * @property Delivery $delivery
 * @property ShippingVendor $shippingVendor
 */
class ShippingPrice extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['shipping_vendor_id', 'delivery_id', 'country_id', 'city_id', 'area_id', 'type', 'price', 'created_at', 'updated_at'];

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
    public function delivery()
    {
        return $this->belongsTo('Modules\TomatoOrders\App\Models\Delivery');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function shippingVendor()
    {
        return $this->belongsTo('Modules\TomatoOrders\App\Models\ShippingVendor');
    }
}
