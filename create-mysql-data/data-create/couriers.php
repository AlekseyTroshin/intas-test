<?php

function couriers($amountCouriers) 
{
	require_once './pdo/Courier.php';
	require_once './data/names.php';
	
	$couriers = [];

	$count = count($names);

	for ($i = 0; $i < $amountCouriers; $i++) {
	    $name = getRandomItemArr($names, 0, $count);
	    $name .= ' ' . getRandomItemArr($surname, 0, $count);
	    $name .= ' ' . getRandomItemArr($familyName, 0, $count);
	    $couriers[] = new Courier($i +1, $name);
	}

	return $couriers;
}