<?php

$dropTableTrips = "DROP TABLE IF EXISTS trips;";

$createTableTrips = "CREATE TABLE trips (\n";
$createTableTrips .= "\tid INT AUTO_INCREMENT PRIMARY KEY,\n";
$createTableTrips .= "\tcourier_id INT,\n";
$createTableTrips .= "\tregion_id INT,\n";
$createTableTrips .= "\tdeparture_date DATE,\n";
$createTableTrips .= "\tarrival_date DATE,\n";
$createTableTrips .= "\treturn_date DATE,\n";
$createTableTrips .= "\tFOREIGN KEY (courier_id) REFERENCES couriers(id),\n";
$createTableTrips .= "\tFOREIGN KEY (region_id) REFERENCES regions(id)\n";
$createTableTrips .= ");";


function createDataTrips($data) 
{

	$dataInsertInto = "INSERT INTO trips (id, courier_id, region_id, departure_date, arrival_date, return_date) VALUES\n";

	foreach ($data as $item) {
		$dataInsertInto .= "({$item->getId()}, {$item->getCourierId()}, {$item->getRegionId()}, '{$item->getDepartureDate()}', '{$item->getArrivalDate()}', '{$item->getReturnDate()}'),\n";
	}
	$dataInsertInto = rtrim($dataInsertInto, "\n,");
	$dataInsertInto .= ';';

	return $dataInsertInto;

}