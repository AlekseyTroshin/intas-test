<?php

namespace app\models;

use core\Model;
use PDO;

class RegionsModel extends Model
{

    public function getAllRegions()
    {
        $sql = "
            SELECT
                id,
                name,
                travel_days,
                travel_days_back
            FROM
                regions
        ";

        $stmt = $this->connection->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getRegionById($id)
    {
        $sql = "
            SELECT
                id,
                name,
                travel_days,
                travel_days_back
            FROM
                regions
            WHERE 
                id = :id
        ";

        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

}