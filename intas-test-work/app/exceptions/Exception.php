<?php

namespace app\exceptions;

class Exception
{

    public function sortException($url)
    {
        if (!isset($url[1], $url[2])) {
            return json_encode(["status" => "error", "message" => "ошибка !"]);
        }

        $param = filter_var($url[1], FILTER_SANITIZE_STRING);
        $sort = filter_var($url[2], FILTER_SANITIZE_STRING);

        $validParams = ["departure_date", "arrival_date", "return_date"];
        $validSortOptions = ["ASC", "DESC"];

        if (!in_array($param, $validParams) || !in_array($sort, $validSortOptions)) {
            return json_encode(["status" => "error", "message" => "ошибка !"]);
        }
    }

}