<?php 

function createFileMysqlData() 
{
	require_once './data-create/trips.php';

	require_once './data-create-for-mysql/mysql-data-regions.php';
	require_once './data-create-for-mysql/mysql-data-couriers.php';
	require_once './data-create-for-mysql/mysql-data-trips.php';

	$data = getTrips();

	$regions = $data['regions'];
	$couriers = $data['couriers'];
	$trips = $data['trips'];

	$createData = '';
	  
	$createData .= $dropTableTrips;
	$createData .= "\n\n";
	$createData .= $dropTableRegions;
	$createData .= "\n\n";
	$createData .= $dropTableCouriers;
	$createData .= "\n\n";

	$createData .= $createTableRegions;
	$createData .= "\n\n";
	$createData .= $createTableCouriers;
	$createData .= "\n\n";
	$createData .= $createTableTrips;
	$createData .= "\n\n";

	$createData .=  createDataRegions($regions); 
	$createData .= "\n\n";
	$createData .= createDataCouriers($couriers);
	$createData .= "\n\n";
	$createData .=  createDataTrips($trips);

	file_put_contents('./intas_db_test_work.sql', $createData);
}

createFileMysqlData();