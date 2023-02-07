<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;

/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class CouponsController extends Controller
{
    public function index()
    {
        return view(
            'pages/coupons'
        );
    }
}
