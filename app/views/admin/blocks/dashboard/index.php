
<section id="main">
    <div class="container-fluid">
        <div class="page-header page-header-block">
            <div class="row-fluid">
                <div class="col-md-8">
                    <h4 class="title"><?php __('Dashboard'); ?></h4>
                </div>
                <div class="col-md-4 text-right">
                    <div class="col-xs-8">
                        <select id="sessionMatrix" class="form-control">
                            <option><?php __('Select Duration'); ?></option>
                            <option><?php __('Today'); ?></option>
                            <option><?php __('Last Day'); ?></option>
                            <option><?php __('Last Week'); ?></option>
                            <option><?php __('Last Month'); ?></option>
                            <option><?php __('Last 6 Month'); ?></option>
                            <option><?php __('Last Year'); ?></option>
                            <option><?php __('All Time'); ?></option>
                        </select>
                    </div>
                    <div class="col-xs-4">
                        <button class="btn btn-primary">
                            <i class="glyphicon glyphicon-refresh"></i>
                        </button>
                    </div>
                    <div class="clearfix"></div>
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

