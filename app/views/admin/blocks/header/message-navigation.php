<li class="dropdown">
    <a claass="dropdown-toggle" data-toggle="dropdown" title="<?php __('Messages'); ?>">
        <i class="fa fa-envelope-o"></i>
        <?php if (count_user_messages()) : ?>
            <span class="hasAlert danger"></span>
        <?php endif; ?>    
    </a>
    <div class="dropdown-menu" id="messages-panel">

        <div class="dropdown-header">
            <span class="title"><?php __('Messages'); ?> <span class="count">(<?php echo count_user_messages(); ?>)</span></span>
            <span class="option text-right">
                <a href="<?php _u('admin/dashboard/write_message'); ?>">
                    <?php __('New Message'); ?>
                </a>
            </span>
        </div>
        <div class="media-list slimScroll">
            <?php
            echo get_user_messages();
            ?>

        </div>
        <div class="dropdown-footer">
            <a href="<?php _u('admin/dashboard/messages'); ?>" title="<?php __('View All Messages'); ?>">
                <strong><?php __('View All Messages'); ?></strong>
            </a>

        </div>
    </div>
</li>