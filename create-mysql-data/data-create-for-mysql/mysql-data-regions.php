<?php

$dropTableRegions = "DROP TABLE IF EXISTS regions;";

$createTableRegions = "CREATE TABLE regions (\n";
$createTableRegions .= "\tid INT AUTO_INCREMENT PRIMARY KEY,\n";
$createTableRegions .= "\tname VARCHAR(255) NOT NULL,\n";
$createTableRegions .= "\ttravel_days INT NOT NULL DEFAULT 0,\n";
$createTableRegions .= "\ttravel_days_back INT NOT NULL DEFAULT 0\n";
$createTableRegions .= ");";


function createDataRegions($data) 
{

	$dataInsertInto = "INSERT INTO regions (id, name, travel_days, travel_days_back) VALUES\n";

	foreach ($data as $item) {
		$dataInsertInto .= "({$item->getId()}, '{$item->getName()}', {$item->getDays()}, {$item->getDaysBack()}),\n";
	}
	$dataInsertInto = rtrim($dataInsertInto, "\n,");
	$dataInsertInto .= ';';
	
	return $dataInsertInto;
}
