
<h2><?php __('My Dashboard'); ?></h2>

<br />
<strong>Hello, <?php echo current_user_name(); ?></strong>

<p>From your Account Dashboard you have the ability to view a snapshot of your recent account activity and update your account information. 
    Select your place below to view or edit information.</p>

<div class="page-title">
    <h3>Account Information</h3>
</div>
<hr />
<div class="row-fluid">
    <div class="col-md-6">
        <h6>
            <strong>Profile</strong>    
            <small><?php _a('account/edit/'.user::id(), __('Edit', true), ' class="pull-right" ') ?></small>
        </h6>

        <p>
            <?php echo user::username(); ?>
            <small class="muted"> ( <?php echo user::user_group(); ?> )</small><br />

        </p>
    </div>
    <div class="col-md-6">
        <strong>Account</strong>
        <p>
            <small class="muted"><?php echo user::email(); ?></small><br />
            <small><?php _a('account/change_password_box', __('Change Password', true), ' class="ajax-box" ') ?></small>
        </p>
    </div>

    <div class="clearfix"></div>
</div>





