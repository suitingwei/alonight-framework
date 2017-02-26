<?php

namespace App\Http\Controllers;

use App\Models\User;

/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class HomeController
{
    /**
     * @return mixed
     */
    public function index()
    {
        return User::all();
    }
}
