<li class="dropdown">
    <?php
    $notice_link = (count_user_notifications()) ? 'claass="dropdown-toggle" data-toggle="dropdown"' : 'href="' . site_url('admin/dashboard/notifications') . '"';
    ?>
    <a title="<?php __('Notifications'); ?>" <?php echo $notice_link; ?>>
        <i class="fa fa-bell-o"></i>
        <?php if (count_user_notifications()) : ?>
            <span class="hasAlert danger"></span>
        <?php endif; ?>    
    </a>
    <?php
    if (count_user_notifications()) {
        ?>
        <div class="dropdown-menu" id="notification-panel">

            <div class="dropdown-header">
                <span class="title"><?php __('Notification'); ?> <span class="count">(<?php echo count_user_notifications(); ?>)</span></span>
                <span class="option text-right"><a href="<?php _u('admin/dashboard/clear_notice') ?>"><?php __('Clear all'); ?></a></span>
            </div>
            <div class="media-list slimScroll">
                <?php echo get_user_notifications(); ?>
            </div>

        </div>
    <?php } ?>
</li>