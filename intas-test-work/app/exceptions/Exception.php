<?php

namespace app\exceptions;

class Exception
{

    public function sortException($url)
    {
        if (!isset($url[1], $url[2])) {
            return json_encode(["status" => "error", "message" => "ошибка сортировки !"]);
        }

        $param = filter_var($url[1], FILTER_SANITIZE_STRING);
        $sort = filter_var($url[2], FILTER_SANITIZE_STRING);

        $validParams = ["departure_date", "arrival_date", "return_date"];
        $validSortOptions = ["ASC", "DESC"];

        if (!in_array($param, $validParams) || !in_array($sort, $validSortOptions)) {
            return json_encode(["status" => "error", "message" => "ошибка сортировки !"]);
        }

        return null;
    }

    public function addTripException($data)
    {
        $regionId = $data['region'] ?? null;
        $courierId = $data['courier'] ?? null;

        if ($regionId && $courierId) {
            return json_encode(["status" => "error", "message" => "ошибка добавления маршрута !"]);
        }

        $regionId = filter_var($regionId, FILTER_SANITIZE_STRING);
        $courierId = filter_var($courierId, FILTER_SANITIZE_STRING);

        if (!(is_int($regionId) && is_int($courierId))) {
            return json_encode(["status" => "error", "message" => "ошибка добавления маршрута !"]);
        }

        return null;
    }

}