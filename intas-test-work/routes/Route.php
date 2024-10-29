<?php

namespace routes;

use app\controllers\App;

class Route
{

    protected static function separatorQueryString($url)
    {
        if ($url) {
            return explode('/', $url);
        }
        return '';
    }

    public static function dispatch($url)
    {
        $app = new App();

        $url = self::separatorQueryString($url);
        $param = $url[0];

        if ($param === 'add-trip') {
            $app->addTrip();
        } else if ($param === 'create-courier') {
            $app->createCourier();
        } else if ($param === 'sort') {
            $app->sort($url);
        } else if ($param === 'region') {
            $app->region($url);
        } else if ($param === 'get-all-couriers') {
            $app->getAllCouriers();
        } else {
            $app->view();
        }
    }
}