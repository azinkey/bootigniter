
<div id="menu" class="sidebar sidebar-left sidebar-menu">

    <div class="menu-wrapper">

        <ul class="nav menu" id="sidebarMenu">
            <li>
                <a href="<?php _u('admin/dashboard'); ?>">
                    <i class="fa fa-fw fa-dashboard"></i>
                    <span class="menu-text"><?php __('Dashboard'); ?></span>
                    <?php
                    $count_notification = count_user_notifications() + count_user_messages();
                    if ($count_notification) {
                        ?>
                        <span class="notification pull-right"></span>
                        <?php
                    }
                    ?>
                </a>
            </li>
            <?php echo get_content_types_admin_navigations(); ?>

            <li class="menu-manager">
                <a href="<?php echo site_url('admin/menus'); ?>" title="<?php __('Menus'); ?>">

                    <i class="fa fa-fw fa-tasks"></i>
                    <span class="menu-text"><?php __('Menus'); ?></span>

                </a>
            </li>

            <li class="parent contents-manager">
                <a href="javascript:void(0);" title="<?php __('Contents'); ?>">
                    <i class="fa fa-fw fa-life-saver"></i>
                    <span class="menu-text"><?php __('Contents'); ?></span>
                    <span class="pull-right arrow">></span>
                </a>
                <ul class="submenu">
                    <li class="c1">
                        <a href="<?php echo site_url('admin/contents/fieldsets'); ?>" title="<?php __('Fieldset'); ?>">
                            <i class="fa fa-folder-open"></i>
                            <span class="menu-text"><?php __('Fieldset'); ?></span> 
                        </a>
                    </li>
                    <li class="c2">
                        <a href="<?php echo site_url('admin/contents/fields'); ?>" title="<?php __('Fields'); ?>">
                            <i class="fa fa-ellipsis-h"></i>
                            <span class="menu-text"><?php __('Fields'); ?></span> 
                        </a>
                    </li>
                    <li class="c4">
                        <a href="<?php echo site_url('admin/contents/types'); ?>" title="<?php __('Types'); ?>">
                            <i class="fa fa-sliders"></i>
                            <span class="menu-text"><?php __('Types'); ?></span> 
                        </a>
                    </li>
                    <li class="c5">
                        <a href="<?php echo site_url('admin/contents/groups'); ?>" title="<?php __('Groups'); ?>">
                            <i class="fa fa-folder-open-o"></i>
                            <span class="menu-text"><?php __('Groups'); ?></span> 
                        </a>
                    </li>
                   
                    <li class="c8">
                        <a href="<?php echo site_url('admin/contents/languages'); ?>" title="<?php __('Languages'); ?>">
                            <i class="fa fa-language"></i>
                            <span class="menu-text"><?php __('Languages'); ?></span> 
                        </a>
                    </li>
                </ul>
            </li>
            <li class="parent">
                <a href="javascript:void(0);" title="<?php __('Accounts'); ?>">
                    <i class="fa fa-fw fa-users"></i>
                    <span class="menu-text"><?php __('Accounts'); ?></span>
                    <span class="pull-right arrow">></span>
                </a>
                <ul class="submenu">
                    <li class="a1">
                        <a href="<?php echo site_url('admin/users/index/1'); ?>" title="<?php __('Users'); ?>">
                            <i class="fa fa-fw fa-user"></i>
                            <span class="menu-text"><?php __('Users'); ?></span> 
                        </a>
                    </li>
                    <li class="a2">
                        <a href="<?php echo site_url('admin/users/groups'); ?>" title="<?php __('Groups'); ?>">
                            <i class="fa fa-fw fa-user-md"></i>
                            <span class="menu-text"><?php __('Groups'); ?></span> 
                        </a>
                    </li>
                    <li class="a3">
                        <a href="<?php echo site_url('admin/users/accesses'); ?>" title="<?php __('Accesses'); ?>">
                            <i class="fa fa-fw fa-eye-slash"></i>
                            <span class="menu-text"><?php __('Accesses'); ?></span> 
                        </a>
                    </li>
                    <?php if (user::access_id() == 1) { ?>
                        <li class="a4">
                            <a href="<?php echo site_url('admin/users/permissions'); ?>" title="<?php __('Permissions'); ?>">
                                <i class="fa fa-fw fa-unlock-alt"></i>
                                <span class="menu-text"><?php __('Permissions'); ?></span> 
                            </a>
                        </li>
                    <?php } ?>
                </ul>
            </li>
            <li>
                <a href="<?php echo site_url('admin/settings'); ?>" title="<?php __('Configurations'); ?>">
                    <i class="fa fa-fw fa-gears"></i>
                    <span class="menu-text"><?php __('Settings'); ?></span>
                </a>
            </li>
        </ul>
    </div>
</div>
