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
        $userModel = new User();
        $results = ($userModel->all());
        var_dump($results);
        foreach ($results as $row) {
            var_dump($row);
        }
    }
}
