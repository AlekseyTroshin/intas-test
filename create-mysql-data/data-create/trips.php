<?php

function getTrips() 
{
	require_once './pdo/Trip.php';

	require_once './data-create/couriers.php';
	require_once './data-create/regions.php';
	require_once './data-create/date.php';

	$trips = [];

	$regionsAmount = 10;
	$couriersAmount = 10;
	$daysAmount = 90;

	$regions = regions($regionsAmount);
	$couriers = couriers($couriersAmount);
	$calendar = getDays($daysAmount);

	$trip = null;
	$tripId = 1;

	for ($i = 0; $i < $daysAmount; $i++) {

		$date = $calendar[$i];

		foreach ($couriers as $courier) {
			$days = $courier->getDays();
			$daysOff = $courier->getDaysOff();
			$isBusy = $courier->isBusy();

			
			if ($days === 0 && $daysOff !== 0) {
				$courier->setBusy(false);
				$courier->setDaysOff(--$daysOff);
				continue;
			}

			if ($days === 0) {
				$trip = new Trip($tripId);
				
				$randomRegion = getRandomItemArr($regions, 0, $regionsAmount);
				$randomRegionDays = $randomRegion->getDays();
				$randomRegionDaysBack = $randomRegionDays + $randomRegion->getDaysBack();

				$courier->setDays($randomRegionDaysBack);
				$courier->setBusy(true);
				$courier->setDaysOff(getRandomNum(3, 5));

				$trip->setCourierId($courier->getId());
				$trip->setRegionId($randomRegion->getId());
				$trip->setDepartureDate($date);
				$trip->setArrivalDate(getDeliveryDate($date, $randomRegionDays));
				$trip->setReturnDate(getDeliveryDate($date, $randomRegionDaysBack));

				$tripId++;

				$trips[] = $trip;
			} else if ($days !== 0) {
				$courier->setDays(--$days);
			}
		}
	}

	return [
		'regions' => $regions,
		'couriers' => $couriers,
		'trips' => $trips,
	];
}
