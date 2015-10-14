<div class="row-fluid">
    <div class="panel-default">
        <?php
        echo form_open('account/update', array('role' => 'form', 'class' => 'panel'));
        ?>
        <div class="panel-heading">
            <h4><?php __('Change Password'); ?></h4>
        </div>
        <div class="panel-body">

            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-tower"></span>
                    </span>
                    <?php
                    $password = array(
                        'name' => 'old_password',
                        'id' => 'old_password',
                        'class' => 'form-control',
                        'maxlength' => '20',
                        'placeholder' => 'Old Password',
                        'autocomplete' => 'off',
                    );
                    echo form_password($password);
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
                        'placeholder' => 'New Password',
                    );
                    echo form_password($password);
                    ?>
                </div>
                <br />
                <div class="input-group">
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-repeat"></span>
                    </span>
                    <?php
                    $password = array(
                        'name' => 'confirm_password',
                        'id' => 'confirm_password',
                        'class' => 'form-control',
                        'maxlength' => '20',
                        'placeholder' => 'Confirm Password',
                    );
                    echo form_password($password);
                    ?>
                </div>

                <hr />
                <div>
                    <?php echo form_hidden('id', user::id()); ?>
                    <button class="btn btn-lg btn-danger btn-block" type="submit">
                        <span class="glyphicon glyphicon-refresh"></span>
                        <?php __('Update') ?>
                    </button>

                </div>

            </div>
        </div>

        <?php
        echo form_close();
        ?>
    </div>
</div>