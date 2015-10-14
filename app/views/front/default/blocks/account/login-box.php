<div class="row-fluid">
    <div>
        <?php
        echo form_open('account/authenicate', array('role' => 'form', 'class' => 'panel'));
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
                        <span class="glyphicon glyphicon-lock"></span>
                    </span>
                    <?php
                    $password = array(
                        'name' => 'password',
                        'id' => 'password',
                        'class' => 'form-control',
                        'maxlength' => '20',
                        'placeholder' => __('Password',true),
                    );
                    echo form_password($password);
                    ?>
                </div>

                <hr />
                <div class="form-stack has-icon">
                    <button class="btn btn-lg btn-danger btn-block" type="submit">
                        <?php __('Login') ?>
                        <span class="glyphicon glyphicon-log-in"></span>
                    </button>

                </div>

            </div>
        </div>

        <?php
        echo form_close();
        ?>
    </div>
</div>