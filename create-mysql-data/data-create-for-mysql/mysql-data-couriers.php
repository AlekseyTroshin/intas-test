<?php

$dropTableCouriers = "DROP TABLE IF EXISTS couriers;";

$createTableCouriers = "CREATE TABLE couriers (\n";
$createTableCouriers .= "\tid INT AUTO_INCREMENT PRIMARY KEY,\n";
$createTableCouriers .= "\tname VARCHAR(255) NOT NULL,\n";
$createTableCouriers .= "\tis_busy BOOLEAN DEFAULT FALSE\n";
$createTableCouriers .= ");";

function createDataCouriers($data) 
{

	$dataInsertInto = "INSERT INTO couriers (id, name, is_busy) VALUES\n";

	foreach ($data as $item) {
		$isBusy = $item->isBusy() ? $item->isBusy() : 'NULL';
		$dataInsertInto .= "({$item->getId()}, '{$item->getName()}', {$isBusy}),\n";
	}
	$dataInsertInto = rtrim($dataInsertInto, "\n,");
	$dataInsertInto .= ';';
	
	return $dataInsertInto;
}