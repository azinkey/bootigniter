<div class="row-fluid">
    <div class="col-sm-4">
        <div class="card-layout">
            <div class="col-xs-4 panel success icon-box">
                <div class="text-center">
                    <a href="<?php _u('admin/users'); ?>">
                        <span class="glyphicon glyphicon-user"></span>
                    </a>
                </div>
            </div>
            <div class="col-xs-8 panel icon-box-detail">
                <div class="panel-body text-center">
                    <h4 class="semibold nm"><?php echo $total_users; ?></h4>
                    <p class="semibold text-muted"><?php __('Users') ?></p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="card-layout">
            <div class="col-xs-4 panel info icon-box">
                <div class="text-center">
                    <a href="<?php _u('admin/dashboard/messages'); ?>">
                        <span class="glyphicon glyphicon-envelope"></span>
                    </a>
                </div>
            </div>
            <div class="col-xs-8 panel icon-box-detail">
                <div class="panel-body text-center">
                    <h4 class="semibold nm"><?php echo $total_messages; ?></h4>
                    <p class="semibold text-muted"><?php __('Messages') ?></p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="card-layout">
            <div class="col-xs-4 panel warning icon-box">
                <div class="text-center">
                    <a href="<?php _u('admin/dashboard/notifications'); ?>">
                        <span class="glyphicon glyphicon-bell"></span>
                    </a>
                </div>
            </div>
            <div class="col-xs-8 panel icon-box-detail">
                <div class="panel-body text-center">
                    <h4 class="semibold nm"><?php echo $total_notification; ?></h4>
                    <p class="semibold text-muted"><?php echo __('Notifications'); ?></p>
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
</div>