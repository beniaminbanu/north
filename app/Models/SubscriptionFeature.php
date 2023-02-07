<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\SubscriptionType;

class SubscriptionFeature extends Model
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
    public function subscriptionType()
    {
        return $this->belongsTo(SubscriptionType::class);
    }
}
