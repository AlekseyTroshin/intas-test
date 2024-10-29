<?php

namespace core;

use routes\Route;

class App
{
    public function __construct()
    {
        $query = trim(urldecode($_SERVER['QUERY_STRING']), '/');
        Route::dispatch($query);
    }

}