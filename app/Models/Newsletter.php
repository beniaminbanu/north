<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * Class Newsletter
 * @package App
 */
class Newsletter extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'email',
        'token',
        'confirmed_at'
    ];

    /**
     * @var array
     */
    protected $casts = [
        'confirmed_at' => 'date'
    ];

    /**
     * @param string $email
     * @return Newsletter
     */
    public static function register(string $email)
    {
        return self::firstOrCreate(['email' => $email], [
            'token'        => Str::random(60),
            'confirmed_at' => Carbon::now()->toDateTimeString()
        ]);
    }
}
