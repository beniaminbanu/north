<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ProviderDescription;
use App\Models\EnergyType;
use App\Models\SubscriptionType;
use Carbon\Carbon;

/**
 * Class Provider
 * @package App
 *
 * @property int id
 * @property int anre_provider_id
 * @property int energy_type_id
 * @property string name
 * @property string type
 * @property string|null link
 * @property string|null image
 * @property string|null image_grey
 * @property string|null icon
 * @property int order
 * @property string status
 *
 */
class Provider extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'anre_provider_id',
        'name',
        'gas_percentage',
        'hydro_percentage',
        'nuclear_percentage',
        'wind_percentage',
        'sun_percentage',
        'other_percentage',
        'energy_type_id',
        'link',
        'image',
        'image_grey',
        'icon',
        'type',
        'order',
        'status'
    ];

    /**
     * @var string
     */
    const ENUM_ACTIVE = 'active';

    /**
     * @var string
     */
    const ENUM_INACTIVE = 'inactive';

    /**
     * @return mixed
     */
    public function descriptions()
    {
        return $this->hasMany(ProviderDescription::class, 'provider_id', 'id');
    }

    public function offers()
    {
        return $this->hasMany(Offer::class, 'provider_id', 'id');
    }

    /**
     * @return mixed
     */
    public function energyType()
    {
        return $this->belongsTo(EnergyType::class);
    }

    /**
     * @return mixed
     */
    public function subscriptionTypes()
    {
        return $this->belongsToMany(SubscriptionType::class);
    }

    public function filteredOffers($zone_id = null)
    {
        return $zone_id ? ($this->hasMany(Offer::class, 'provider_id', 'id')->where('zone_id', $zone_id)->where('valid_to', '>', Carbon::now()->toDateTimeString())->get()->isNotEmpty() ? $this->hasMany(Offer::class, 'provider_id', 'id')->where('zone_id', $zone_id)->where('valid_to', '>', Carbon::now()->toDateTimeString())->get() : $this->hasMany(Offer::class, 'provider_id', 'id')->where('zone_id', $zone_id)->orderBy('valid_to', 'desc')->take(1)->get()) : $this->hasMany(Offer::class, 'provider_id', 'id')->where('valid_to', '>', Carbon::now()->toDateTimeString())->get();
    }

    public function banks()
    {
        return $this->belongsToMany('App\Models\Bank');
    }

    public function atms()
    {
        return $this->belongsToMany('App\Models\Atm');
    }

    public function payment_methods()
    {
        return $this->belongsToMany('App\Models\PaymentMethod');
    }

    /**
     * @return mixed
     */
    public function comments()
    {
        return $this->hasMany(Comment::class, 'provider_id', 'id');
    }
}
