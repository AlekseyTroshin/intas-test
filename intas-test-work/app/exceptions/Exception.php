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

        if (!$regionId && !$courierId) {
            return json_encode(["status" => "error", "message" => "ошибка добавления маршрута !"]);
        }

        $regionId = filter_var($regionId, FILTER_VALIDATE_INT);
        $courierId = filter_var($courierId, FILTER_VALIDATE_INT);

        if (!$regionId && !$courierId) {
            return json_encode(["status" => "error", "message" => "ошибка добавления маршрута !"]);
        }

        return null;
    }

    public function createCourierException($data)
    {
        $nsf = $data['nsf'] ?? null;

        if (!$nsf) {
            return json_encode(["status" => "error", "message" => "ошибка найма нового курьера !"]);
        }

        $nsf = filter_var($nsf, FILTER_SANITIZE_STRING);

        if (!$nsf) {
            return json_encode(["status" => "error", "message" => "ошибка найма нового курьера !"]);
        }

        return null;
    }


    public function checkSelectedDateException($url)
    {
        if (!isset($url[1])) {
            return json_encode(["status" => "error", "message" => "ошибка передачи даты !"]);
        }

        $param = filter_var($url[1], FILTER_SANITIZE_STRING);

        if (!$param) {
            return json_encode(["status" => "error", "message" => "ошибка  передачи даты !"]);
        }

        return null;
    }

}