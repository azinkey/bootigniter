

<section id="main">
    <div class="container-fluid">
        <div class="page-header page-header-block">
            <div class="row-fluid">
                <div class="col-xs-7">
                    <h4 class="title">
                        <span class="glyphicon glyphicon-user"></span>
                        <?php echo (isset($user->username)) ? $user->username : lang('New User'); ?>
                    </h4>
                </div>
                <div class="col-xs-5">
                    <div class="btn-group pull-right">
                        <a href="<?php _u('admin/users/index/' . form_value('gid', $user)); ?>" class="btn btn-default btn-sm">
                            <i class="fa fa-arrow-circle-left"></i>
                        </a>
                        <button type="button" class="btn btn-primary  btn-sm click-submit" data-form="#saveUserForm">
                            <i class="fa fa-save"></i>
                        </button>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        <?php AZ::block('system-message'); ?>
        <div class="row-fluid">
            <?php echo form_open_multipart('admin/users/save', array('id' => 'saveUserForm')); ?>

            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="panel-group" id="accordion">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                        <span class="glyphicon pull-left hidden-xs"></span>
                                        <?php __('Account'); ?>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseOne" class="panel-collapse collapse in">
                                <div class="panel-body">
                                    <div class="field-row row-fluid">
                                        <div class="col-md-4">
                                            <?php
                                            echo form_label(lang('Username'), 'username');
                                            ?>
                                        </div>
                                        <div class="col-md-8">
                                            <?php
                                            echo form_input(array(
                                                'class' => 'form-control',
                                                'name' => 'username',
                                                'autocomplete' => 'off',
                                                'value' => isset($user->username) ? $user->username : '',
                                            ));
                                            ?>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="field-row row-fluid">
                                        <div class="col-md-4">
                                            <?php
                                            echo form_label(lang('Name'), 'name');
                                            ?>
                                        </div>
                                        <div class="col-md-8">
                                            <?php
                                            echo form_input(array(
                                                'class' => 'form-control',
                                                'name' => 'name',
                                                'value' => isset($user->name) ? $user->name : '',
                                            ));
                                            ?>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>

                                    <div class="field-row row-fluid">
                                        <div class="col-md-4">
                                            <?php
                                            echo form_label(lang('Email'), 'email');
                                            ?>
                                        </div>
                                        <div class="col-md-8">
                                            <?php
                                            echo form_input(array(
                                                'class' => 'form-control',
                                                'name' => 'email',
                                                'value' => isset($user->email) ? $user->email : '',
                                            ));
                                            ?>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="field-row row-fluid">
                                        <div class="col-md-4">
                                            <?php echo form_label(lang('Group'), 'gid'); ?>
                                        </div>
                                        <div class="col-md-8">
                                            <?php
                                            echo form_dropdown('gid', user_groups_A(), isset($user->gid) ? $user->gid : 0, 'class="form-control"');
                                            ?>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="field-row row-fluid">
                                        <div class="col-md-4">
                                            <?php echo form_label(lang('Status'), 'status'); ?>
                                        </div>
                                        <div class="col-md-8">
                                            <?php
                                            echo form_dropdown('status', user_status_A(), isset($user->status) ? $user->status : 1, 'class="form-control"');
                                            ?>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                                        <span class="glyphicon pull-left hidden-xs"></span>
                                        <?php __('Profile'); ?>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseTwo" class="panel-collapse collapse in">
                                <div class="panel-body">
                                    <div class="field-row row-fluid">
                                        <div class="col-md-4">
                                            <?php echo form_label(lang('Avatar'), 'avator'); ?>
                                        </div>
                                        <div class="col-md-8">
                                            <span class="btn btn-file">
                                                <?php $avatar = isset($user->avatar) ? $user->avatar : 'media/users/avatar.png'; ?>
                                                <img src="<?php echo media_url($avatar); ?>" width="32" height="32" alt=".." class="pull-left img-circle"/>
                                                <?php echo form_upload(array('name' => 'avatar', 'id' => 'profileAvatar')); ?>
                                                <span class="clearfix"></span>
                                            </span>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="field-row row-fluid">
                                        <div class="col-md-4">
                                            <?php echo form_label(lang('Address'), 'address'); ?>
                                        </div>
                                        <div class="col-md-8">
                                            <?php
                                            echo form_input(array(
                                                'class' => 'form-control',
                                                'name' => 'address',
                                                'value' => form_value('address', $user),
                                            ));
                                            ?>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="field-row row-fluid">
                                        <div class="col-md-4">
                                            <?php echo form_label(lang('City'), 'city'); ?>
                                        </div>
                                        <div class="col-md-8">
                                            <?php
                                            echo form_input(array(
                                                'class' => 'form-control',
                                                'name' => 'city',
                                                'value' => form_value('city', $user),
                                            ));
                                            ?>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="field-row row-fluid">
                                        <div class="col-md-4">
                                            <?php echo form_label(lang('Pincode'), 'pincode'); ?>
                                        </div>
                                        <div class="col-md-8">
                                            <?php
                                            echo form_input(array(
                                                'class' => 'form-control',
                                                'name' => 'pincode',
                                                'value' => form_value('pincode', $user),
                                            ));
                                            ?>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="field-row row-fluid">
                                        <div class="col-md-4">
                                            <?php
                                            echo form_label(lang('State'), 'state');
                                            ?>
                                        </div>
                                        <div class="col-md-8">
                                            <?php
                                            echo form_input(array(
                                                'class' => 'form-control',
                                                'name' => 'state',
                                                'value' => form_value('state', $user),
                                            ));
                                            ?>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="field-row row-fluid">
                                        <div class="col-md-4">
                                            <?php
                                            echo form_label(lang('Country'), 'country');
                                            ?>
                                        </div>
                                        <div class="col-md-8">
                                            <?php
                                            echo form_input(array(
                                                'class' => 'form-control',
                                                'name' => 'country',
                                                'value' => form_value('country', $user),
                                            ));
                                            ?>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="field-row row-fluid">
                                        <div class="col-md-4">
                                            <?php
                                            echo form_label(lang('Phone'), 'phone');
                                            ?>
                                        </div>
                                        <div class="col-md-8">
                                            <?php
                                            echo form_input(array(
                                                'class' => 'form-control',
                                                'name' => 'phone',
                                                'value' => form_value('phone', $user),
                                            ));
                                            ?>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                                        <span class="glyphicon pull-left hidden-xs"></span>
                                        <?php __('Password'); ?>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseThree" class="panel-collapse collapse in">
                                <div class="panel-body">
                                    <div class="field-row row-fluid">
                                        <div class="col-md-4">
                                            <?php
                                            echo form_label(lang('Password'), 'password');
                                            ?>
                                        </div>
                                        <div class="col-md-8">
                                            <?php
                                            echo form_password(array(
                                                'class' => 'form-control',
                                                'name' => 'password',
                                                'autocomplete' => 'off',
                                            ));
                                            ?>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="field-row row-fluid">
                                        <div class="col-md-4">
                                            <?php
                                            echo form_label(lang('Confirm Password'), 'cpassword');
                                            ?>
                                        </div>
                                        <div class="col-md-8">
                                            <?php
                                            echo form_password(array(
                                                'class' => 'form-control',
                                                'name' => 'cpassword',
                                                'autocomplete' => 'off',
                                            ));
                                            ?>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <div class="col-md-12 text-right">
                        <?php echo (isset($user->id)) ? form_hidden('id', $user->id) : ''; ?>
                        <a href="<?php _u('admin/users/index/' . form_value('gid', $user)); ?>" class="btn btn-default">
                            <i class="fa fa-arrow-circle-left"></i>
                            <?php __('Cancel'); ?>
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-save"></i>
                            <?php __('Save'); ?>
                        </button>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</section>


