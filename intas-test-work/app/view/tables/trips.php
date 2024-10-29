<?php

/**
 * @var array $dataAll
 */

?>

<table id="table" class="table" data-sort="desc">
    <thead>
    <tr>
        <th>#</th>
        <th>Регион</th>
        <th class="sort" data-param="departure_date">Дата выезда из Москвы</th>
        <th class="sort" data-param="arrival_date">Дата приезда в Регион</th>
        <th>ФИО курьера</th>
        <th class="sort" data-param="arrival_date">Дата выезда из Региона</th>
        <th class="sort" data-param="return_date">Дата приезда в Москву</th>
    </tr>
    </thead>
    <tbody>

    <?php foreach ($dataAll as $item) { ?>
        <tr>
            <td><?= $item['region'] ?></td>
            <td><?= $item['departure_date'] ?></td>
            <td><?= $item['arrival_date'] ?></td>
            <td><?= $item['courier'] ?></td>
            <td><?= $item['arrival_date'] ?></td>
            <td><?= $item['return_date'] ?></td>
        </tr>
    <?php } ?>
    </tbody>
</table>
