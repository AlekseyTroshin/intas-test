<?php

/**
 * @var array $dataAll
 * @var array $regions
 * @var array $couriers
 */

?>

<?php includeView('parts/header'); ?>

    <div class="container mtb-20 wrap-loader">
        <?php
            includeView('forms/add-courier', compact('regions', 'couriers'));
            includeView('forms/add-trip', compact('regions', 'couriers'));
            includeView('tables/trips', compact('dataAll'));
        ?>
    </div>

<?php includeView('parts/footer'); ?>