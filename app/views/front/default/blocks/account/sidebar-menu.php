


<?php if (user::id()) : ?>
    <ul class="list-group">
        <li class="list-group-item"><strong><?php __('My Account'); ?></strong></li>
        <li class="list-group-item">
            <?php _a('account', __('Dashboard', true)) ?>
        </li>
        <li class="list-group-item"><?php _a('account/edit/' . user::id(), __('Account Profile', true)); ?></li>
        <li class="list-group-item"><?php _a('account/change_password_box', __('Change Paassword', true), ' class="ajax-box" '); ?></li>
    </ul>
<?php else: ?>
    <ul class="list-group">
        <li class="list-group-item"><strong><?php __('My Account'); ?></strong></li>
        <li class="list-group-item">
            <?php _a('account/login_box', __('Login', true), ' class="ajax-box" '); ?>
        </li>
        <li class="list-group-item">
            <?php _a('account/register_box', __('Register', true), ' class="ajax-box" '); ?>
        </li>
    </ul>
<?php endif; ?>
