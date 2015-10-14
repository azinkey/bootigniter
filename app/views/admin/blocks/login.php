

<div class="row-fluid">
    <div>
        <hr />
        <?php
        echo form_open('administrator/login', array('role' => 'form', 'class' => 'panel'));
        ?>
        <div class="panel-body">
            <?php
            $this->load->block('system-message', true);
            ?>
            <div class="form-group">
                <div class="form-stack has-icon">
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
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    <?php echo form_error('username', '<small class="text-danger">', '</small>'); ?>
                </div>
                <br />
                <div class="form-stack has-icon">
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
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    <?php echo form_error('password', '<small class="text-danger">', '</small>'); ?>
                </div>                    

                <hr />
                <div class="form-stack has-icon">
                    <button class="btn btn-lg btn-success btn-block" type="submit">
                        <?php __('Login') ?>
                        <span class="glyphicon glyphicon-log-in"></span>
                    </button>

                </div>

            </div>
        </div>

        <?php
        echo form_close();
        ?>
        <hr />
    </div>
</div>
