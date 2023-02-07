<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;

use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;

/**
 * Class HomeController
 *
 * @package App\Admin\Controllers
 */
class HomeController extends Controller
{
    /**
     * @return mixed
     */
    public function index()
    {
        return Admin::content(function (Content $content) {
            $content->header('Dashboard');
        });
    }
}
