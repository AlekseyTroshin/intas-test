<?php

namespace app\models;

use core\Model;
use PDO;

class CouriersModel extends Model
{

    public function getAllCouriers()
    {
        $sql = "
            SELECT
                id,
                name,
                is_busy
            FROM
                couriers
        ";

        $stmt = $this->connection->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCourierById($id)
    {
        $sql = "
            SELECT
                id,
                name,
                is_busy
            FROM
                couriers
            WHERE 
                id = :id
        ";

        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function setBusy($id, $is_busy)
    {
        $sql = "
            UPDATE 
                couriers 
            SET 
                is_busy = :is_busy 
            WHERE 
                id = :id
        ";

        $stmt = $this->connection->prepare($sql);

        $stmt->execute([
            ':id' => $id,
            ':is_busy' => $is_busy
        ]);
    }

    public function createCourier($data)
    {
        $sql = "INSERT INTO couriers (
                   name, 
                   is_busy) 
            VALUES (
                    :name, 
                    :is_busy)";

        $stmt = $this->connection->prepare($sql);

        $values = [
            ':name' => $data['name'],
            ':is_busy' => $data['is_busy']
        ];

        $stmt->execute($values);

        return $data;
    }

}