
<section id="main">
    <div class="container-fluid">
        <div class="page-header page-header-block">
            <div class="row-fluid">
                <div class="col-md-8">
                    <h4 class="title"><?php __('Dashboard'); ?></h4>
                </div>
                <div class="col-md-4 text-right">
                    <?php echo form_open('admin/dashboard', array('id' => 'refreshChart')); ?>
                        <div class="col-xs-8">
                            <?php
                            echo form_dropdown('duration', array(
                                '' => lang('Select Visits'), 
                                'TODAY' => lang('Today'), 
                                '1 DAY' => lang('Last Day'), 
                                '1 WEEK' => lang('Last Week'), 
                                '1 MONTH' => lang('Last Month'), 
                                '6 MONTH' => lang('Last 6 Month'), 
                                '1 YEAR' => lang('Last Year'),
                                '10 YEAR' => lang('All Time'),
                                ), $duration, 'class="form-control" id="sessionMatrix" ');
                            ?>
                        </div>
                        <div class="col-xs-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="glyphicon glyphicon-refresh"></i>
                            </button>
                        </div>
                        <div class="clearfix"></div>
                    <?php echo form_close(); ?>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        <?php AZ::block('system-message'); ?>

        <div class="row-fluid">
            <div class="col-md-8">
                <?php AZ::block('dashboard/widgets'); ?>
                <?php AZ::block('dashboard/visits-chart'); ?>
            </div>
            <div class="col-md-4">
                <?php AZ::block('dashboard/recent-activity'); ?>
            </div>
        </div>


    </div>
</section>

