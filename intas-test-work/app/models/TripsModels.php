<?php

namespace app\models;

use core\Model;
use PDO;

class TripsModels extends Model
{

    public function getTripsAllData()
    {
        $sql = "
            SELECT
                r.name AS region,
                t.departure_date AS departure_date,
                t.arrival_date AS arrival_date,
                t.return_date AS return_date,
                c.name AS courier
            FROM
                trips AS t
            INNER JOIN
                regions AS r ON t.region_id = r.id
            INNER JOIN
                couriers AS c ON t.courier_id = c.id
            ORDER BY
                t.departure_date DESC;
        ";

        $stmt = $this->connection->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTripsAllDataSort($param, $sort)
    {
        $allowedParams = ['departure_date', 'arrival_date', 'return_date'];
        $allowedSort = ['ASC', 'DESC'];

        $param = in_array($param, $allowedParams) ? $param : 'departure_date';
        $sort = in_array($sort, $allowedSort) ? $sort : 'ASC';

        $sql = "
            SELECT
                r.name AS region,
                t.departure_date AS departure_date,
                t.arrival_date AS arrival_date,
                t.return_date AS return_date,
                c.name AS courier
            FROM
                trips AS t
            INNER JOIN
                regions AS r ON t.region_id = r.id
            INNER JOIN
                couriers AS c ON t.courier_id = c.id
            ORDER BY
                t.$param $sort;
        ";

        $stmt = $this->connection->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $sort;
    }

    public function addTrip($data)
    {
        $sql = "INSERT INTO trips (
                   courier_id, 
                   region_id, 
                   departure_date, 
                   arrival_date, 
                   return_date) 
            VALUES (
                    :courier_id, 
                    :region_id, 
                    :departure_date, 
                    :arrival_date, 
                    :return_date)";

        $stmt = $this->connection->prepare($sql);

        $values = [
            ':courier_id' => $data['courier_id'],
            ':region_id' => $data['region_id'],
            ':departure_date' => $data['departure_date'],
            ':arrival_date' => $data['arrival_date'],
            ':return_date' => $data['return_date']
        ];

        $stmt->execute($values);
    }

}