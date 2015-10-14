
<ul class="nav navbar-nav navbar-right">
    <!-- Profile dropdown -->
    <li class="dropdown profile" id="profileMenuIcon">
        <a data-toggle="dropdown" class="dropdown-toggle" href="javascript:void(0);">
            <span class="meta">
                <?php if (user::avatar()) : ?>
                    <span class="avatar">
                        <img alt="" class="img-circle"  src="<?php echo user::avatar(); ?>">
                    </span>
                <?php endif; ?>
                <span class="text hidden-xs hidden-sm pr5 pl5"><?php __(current_user_name()); ?></span>
                <span class="caret"></span>
            </span>
        </a>
        <ul role="menu" class="dropdown-menu dropdown-menu-right profile-dropdown" id="profile-panel">
            <li>
                <a>
                    <strong><?php __(ucfirst(user::username())); ?></strong>
                    <br />
                    <span class="muted">
                        <?php
                        __(user::user_group());
                        ?>
                    </span>
                </a>
            </li>
            <li class="divider"></li>
            <li>
                <a href="<?php _u('admin/users/edit/' . user::id()); ?>">
                    <i class="fa fa-briefcase"></i>
                    <?php __('My Account'); ?>
                </a>
            </li>
            <li class="divider"></li>
            <li>
                <a href="<?php _u('administrator/logout'); ?>">
                    <i class="fa fa-sign-out"></i>
                    <?php __('Sign Out'); ?>
                </a>
            </li>
        </ul>
    </li>
</ul>

