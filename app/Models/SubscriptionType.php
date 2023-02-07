<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\SubscriptionFeature;

class SubscriptionType extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'slug'
    ];

    /**
     * @return mixed
     */
    public function subscriptionFeatures()
    {
        return $this->hasMany(SubscriptionFeature::class);
    }
}
