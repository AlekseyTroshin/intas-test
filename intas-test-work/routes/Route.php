<?php

namespace routes;

use app\controllers\App;
use app\exceptions\Exception;

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
            if ($_SERVER['REQUEST_METHOD'] !== 'POST') return;

            $app->addTrip();
        } else if ($param === 'create-courier') {
            if ($_SERVER['REQUEST_METHOD'] !== 'POST') return;

            $app->createCourier();
        } else if ($param === 'sort') {
            $app->sort($url);
        } else if ($param === 'region') {
            $app->region($url);
        } else if ($param === 'get-all-couriers') {
            $app->getAllCouriers();
        }
        else if ($param === 'check-selected-date') {
            $app->checkSelectedDate($url);
        } else {
            $app->view();
        }
    }
}