<?php

/**
 * @var array $dataAll
 * @var array $regions
 * @var array $couriers
 * @var array $daysDate
 */

?>

<?php includeView('parts/header'); ?>

    <div class="container mtb-20 wrap-loader">
        <?php
            includeView('forms/add-courier', compact('regions', 'couriers'));
            includeView('forms/add-trip', compact('regions', 'couriers'));
            includeView('forms/selected-date', compact('daysDate'));
            includeView('tables/trips', compact('dataAll'));
        ?>
    </div>

<?php includeView('parts/footer'); ?>