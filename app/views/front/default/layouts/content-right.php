

<?php AZ::header(); ?>

<div class="container">

    <div class="row-fluid contents">
        <div class="col-md-8">
            <?php AZ::block($block); ?>

        </div>
        <div class="col-md-4">
            <?php AZ::block('sidebar/right'); ?>
        </div>
        <div class="clearfix"></div>
    </div>

</div>


<?php AZ::footer(); ?>