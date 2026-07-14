<div class="row-fluid">
    <div class="col-sm-4">
        <div class="card-layout">
            <div class="col-4 panel success icon-box">
                <div class="text-center">
                    <a href="<?php _u('admin/users'); ?>">
                        <span class="fa-solid fa-user"></span>
                    </a>
                </div>
            </div>
            <div class="col-8 panel icon-box-detail">
                <div class="card-body text-center">
                    <h4 class="semibold nm"><?php echo $total_users; ?></h4>
                    <p class="semibold text-muted"><?php __('Users') ?></p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="card-layout">
            <div class="col-4 panel info icon-box">
                <div class="text-center">
                    <a href="<?php _u('admin/dashboard/messages'); ?>">
                        <span class="fa-solid fa-envelope"></span>
                    </a>
                </div>
            </div>
            <div class="col-8 panel icon-box-detail">
                <div class="card-body text-center">
                    <h4 class="semibold nm"><?php echo $total_messages; ?></h4>
                    <p class="semibold text-muted"><?php __('Messages') ?></p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="card-layout">
            <div class="col-4 panel warning icon-box">
                <div class="text-center">
                    <a href="<?php _u('admin/dashboard/notifications'); ?>">
                        <span class="fa-solid fa-bell"></span>
                    </a>
                </div>
            </div>
            <div class="col-8 panel icon-box-detail">
                <div class="card-body text-center">
                    <h4 class="semibold nm"><?php echo $total_notification; ?></h4>
                    <p class="semibold text-muted"><?php echo __('Notifications'); ?></p>
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
</div>