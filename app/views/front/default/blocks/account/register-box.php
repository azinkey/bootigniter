<div class="row-fluid">
    <div>
        <?php
        echo form_open('account/register', array('role' => 'form', 'class' => 'panel'));
        ?>
        <div class="panel-body">

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
                        'placeholder' => __('Username',true),
                    );
                    echo form_input($username);
                    ?>
                </div>
                <br />
                <div class="input-group">
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-envelope"></span>
                    </span>
                    <?php
                    $email = array(
                        'name' => 'email',
                        'id' => 'email',
                        'class' => 'form-control',
                        'maxlength' => '32',
                        'placeholder' => __('Email',true),
                    );
                    echo form_input($email);
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
                        'placeholder' => __('Password',true),
                        'autocomplete' => 'off'
                    );
                    echo form_password($password);
                    ?>
                </div>
                <br />
                <div class="input-group">
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon glyphicon-repeat"></span>
                    </span>
                    <?php
                    $confirm = array(
                        'name' => 'confirm_password',
                        'id' => 'confirm_password',
                        'class' => 'form-control',
                        'maxlength' => '20',
                        'placeholder' => __('Confirm Password',true),
                        'autocomplete' => 'off'
                    );
                    echo form_password($confirm);
                    ?>
                </div>

                <hr />
                <div class="form-stack has-icon">
                    <button class="btn btn-lg btn-danger btn-block" type="submit">
                        <?php __('Create') ?> 
                         <span class="glyphicon glyphicon-saved"></span>
                    </button>

                </div>

            </div>
        </div>

        <?php
        echo form_close();
        ?>
    </div>
</div>