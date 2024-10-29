<?php

/**
 * @var array $regions
 * @var array $couriers
 */

$dateToday = new DateTime();

$departure_date = $dateToday->format('Y-m-d');

$dateToday->modify("+{$regions[0]['travel_days']} days");
$arrival_date = $dateToday->format('Y-m-d');

$dateToday->modify("+{$regions[0]['travel_days_back']} days");
$return_date = $dateToday->format('Y-m-d');

?>

<div id="add-trip">
    <div class="form">
        <div class="form-item">
            <div class="form-group">
                <div class="form-group-item">
                    <p class="form-label">Дата выезда из Москвы</p>
                    <p class="form-date form-departure"><?= $departure_date ?></p>
                </div>
                <div class="form-group-item">
                    <p class="form-label">Дата приезда в Регион</p>
                    <p class="form-date form-arrival-a"><?= $arrival_date ?></p>
                </div>
                <div class="form-group-item">
                    <p class="form-label">Дата выезда из Региона</p>
                    <p class="form-date form-arrival-b"><?= $arrival_date ?></p>
                </div>
                <div class="form-group-item">
                    <p class="form-label">Дата приезда в Москву</p>
                    <p class="form-date form-return"><?= $return_date ?></p>
                </div>
            </div>
            <div class="form-option">
                <p class="form-label">Выбрать маршрут</p>
                <select class="form-select form-regions">
                    <?php foreach ($regions as $region) { ?>
                        <?= "<option value=" . $region["id"] . ">" . $region["name"] . "</option>" ?>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="form-item">
            <div class="form-option">
                <p class="form-label">Выбрать курьера</p>
                <select class="form-select form-couriers">
                    <?php foreach ($couriers as $courier) { ?>
                        <?php if ($courier['is_busy']) { ?>
                            <?= "<option value=" . $courier["id"] . " disabled >" . $courier["name"] . "</option>" ?>
                        <?php } else { ?>
                            <?= "<option value=" . $courier["id"] . ">" . $courier["name"] . "</option>" ?>
                        <?php } ?>
                    <?php } ?>
                </select>
                <span class="couriers-all-busy">Все курьеры заняты</span>
            </div>
        </div>
        <div class="form-item">
            <button class="create-trip">Создать заявку</button>
        </div>
    </div>
</div>

