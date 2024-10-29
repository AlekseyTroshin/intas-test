<?php

/**
 * @var array $daysDate
 */

?>

<div id="select-date">
    <div class="form">
        <div class="form-item">
            <div class="form-group">
                <div class="form-group-item">
                    <p class="form-label">Дата выезда из Москвы</p>
                    <input class="select-date-input" type="text" name="date" placeholder="2022-02-02">
                </div>
                <div class="form-option">
                    <p class="form-label">Дата выезда из Москвы</p>
                    <select class="form-select selected-date-select">
                        <option value="all" selected>Все</option>
                        <?php foreach ($daysDate as $day) { ?>
                            <?= "<option value=" . $day["departure_date"] . ">" . $day["departure_date"] . "</option>" ?>
                        <?php } ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="form-item">
            <button class="check-date">Расписание за выбранную дату</button>
        </div>
    </div>
</div>


