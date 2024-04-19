<?php

namespace Modules\TomatoCrm\App\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\TomatoLocations\App\Models\Area;
use Modules\TomatoLocations\App\Models\City;
use Modules\TomatoLocations\App\Models\Country;

/**
 * @property integer $id
 * @property integer $account_id
 * @property string $street
 * @property string $area
 * @property string $city
 * @property string $zip
 * @property boolean $is_main
 * @property string $country
 * @property integer $home_number
 * @property integer $flat_number
 * @property integer $floor_number
 * @property string $mark
 * @property string $map_url
 * @property string $note
 * @property string $lat
 * @property string $lng
 * @property string $created_at
 * @property string $updated_at
 * @property Account $account
 */
class Location extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'account_id',
        'street',
        'zip',
        'is_main',
        'area_id',
        'city_id',
        'country_id',
        'home_number',
        'flat_number',
        'floor_number',
        'mark',
        'map_url',
        'note',
        'lat',
        'lng',
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'is_main' => 'boolean',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function account()
    {
        return $this->belongsTo('Modules\TomatoCrm\App\Models\Account');
    }

    public function city(){
        return $this->belongsTo(City::class, 'city_id', 'id');
    }

    public function area(){
        return $this->belongsTo(Area::class, 'area_id', 'id');
    }

    public function country(){
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }
}
