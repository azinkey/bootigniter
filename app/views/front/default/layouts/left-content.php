

<?php AZ::header(); ?>

<div class="container">
    <?php AZ::block('system-message'); ?>
    
    <div class="row-fluid contents">
        <div class="col-md-3">
            <?php AZ::block('sidebar/left'); ?>
        </div>
        <div class="col-md-9">

            <?php AZ::block($block); ?>

        </div>

        <div class="clearfix"></div>
    </div>

</div>


<?php AZ::footer(); ?>