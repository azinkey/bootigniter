<?php $user_id = user::id(); ?>


<?php if ($user_id): ?>

    <ul class="nav navbar-nav navbar-right profile-menu">

        <li class="dropdown text-right">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="account-icon glyphicon glyphicon-off"></i> 
            </a>
            <ul class="dropdown-menu dropdown-menu-right text-left">
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
                <li><?php _a('account', __('My Account', true)) ?></li>
                <li class="divider"></li>
                <li><?php _a('account/logout', __('Sign Out', true)) ?></li>

            </ul>
        </li>
    </ul>
<?php else: ?>
    <ul class="nav navbar-nav navbar-right profile-menu">

        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="glyphicon glyphicon-user"></i> 
            </a>
            <ul class="dropdown-menu dropdown-menu-right text-left">
                <li><?php _a('account/login_box', __('Log in Account', true), ' class="ajax-box" ') ?></li>
                <li><?php _a('account/register_box', __('Create an Account', true), ' class="ajax-box" ') ?></li>
            </ul>
        </li>
    </ul>

<?php endif; ?>
