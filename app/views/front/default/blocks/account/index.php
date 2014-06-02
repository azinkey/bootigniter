

<div class="page-title">
    <h3><?php __('Login or Create an Account'); ?></h3>
</div>
<hr />

<div class="row-fluid">
    <div class="col-md-6">
        <h2>New Here?</h2>
        <p class="form-instructions">Registration is free and easy!</p>
        <ul class="benefits">
            <li>Faster Process</li>
            <li>Save profile & addresses book</li>
            <li>View and send messages to other users</li>
        </ul>
        <br />
        <hr />
        
        <?php _a('account/register_box', __('Register', true), ' class="ajax-box btn btn-primary btn-block" '); ?>
    </div>
    <div class="col-md-6">
        <h2>Already registered?</h2>
        <p class="form-instructions">If you have an account with us, please log in.</p>
        <div>
            <?php
            echo form_open('account/authenicate', array('role' => 'form'));
            ?>

            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-user"></span>
                    </span>
                    <?php
                    $username = array(
                        'name' => 'username',
                        'id' => 'username',
                        'class' => 'form-control',
                        'maxlength' => '16',
                        'autofocus' => 'true',
                        'placeholder' => 'Username',
                    );
                    echo form_input($username);
                    ?>
                </div>

                <br />
                <div class="input-group">
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-lock"></span>
                    </span>
                    <?php
                    $password = array(
                        'name' => 'password',
                        'id' => 'password',
                        'class' => 'form-control',
                        'maxlength' => '20',
                        'placeholder' => 'Password',
                    );
                    echo form_password($password);
                    ?>
                </div>

                <hr />
                <div class="form-stack has-icon">
                    <button class="btn btn-info btn-block" type="submit">
                        <?php __('Login') ?>
                    </button>

                </div>

            </div>

            <?php
            echo form_close();
            ?>
        </div>
    </div>
    <div class="clearfix"></div>
</div>
