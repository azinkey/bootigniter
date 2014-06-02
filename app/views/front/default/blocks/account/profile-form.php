

<div class="row-fluid">
    <?php echo form_open_multipart('account/update'); ?>

    <div class="panel panel-default">
        <div class="panel-body">
            <div class="panel-group" id="accordion">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">

                                <?php __('Account'); ?>
                            </a>
                        </h4>
                    </div>
                    <div id="collapseOne" class="panel-collapse collapse in">
                        <div class="panel-body">
                            <div class="field-row row-fluid">
                                <div class="col-md-4">
                                    <?php
                                    echo form_label(__('Name', true), 'name');
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
                            <br />
                            <div class="field-row row-fluid">
                                <div class="col-md-4">
                                    <?php
                                    echo form_label(__('Username', true), 'username');
                                    ?>
                                </div>
                                <div class="col-md-8">
                                    <?php
                                    echo form_input(array(
                                        'class' => 'form-control',
                                        'name' => 'username',
                                        'disabled' => true,
                                        'readonly' => true,
                                        'autocomplete' => 'off',
                                        'value' => isset($user->username) ? $user->username : '',
                                    ));
                                    ?>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <br />
                            <div class="field-row row-fluid">
                                <div class="col-md-4">
                                    <?php
                                    echo form_label(__('Email', true), 'email');
                                    ?>
                                </div>
                                <div class="col-md-8">
                                    <?php
                                    echo form_input(array(
                                        'class' => 'form-control',
                                        'name' => 'email',
                                        'disabled' => true,
                                        'readonly' => true,
                                        'value' => isset($user->email) ? $user->email : '',
                                    ));
                                    ?>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <br />
                            <div class="field-row row-fluid">
                                <div class="col-md-4">
                                    <?php echo form_label(__('Group', true), 'gid'); ?>
                                </div>
                                <div class="col-md-8">
                                    <?php
                                    echo form_dropdown('gid', user_groups_A(), isset($user->gid) ? $user->gid : 0, 'class="form-control" disabled="1" readonly="1"');
                                    ?>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <br />
                            <div class="field-row row-fluid">
                                <div class="col-md-4">
                                    <?php echo form_label(__('Status', true), 'status'); ?>
                                </div>
                                <div class="col-md-8">
                                    <?php
                                    echo form_dropdown('status', user_status_A(), isset($user->status) ? $user->status : 1, 'class="form-control" disabled="1" readonly="1"');
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

                                <?php __('Profile'); ?>
                            </a>
                        </h4>
                    </div>
                    <div id="collapseTwo" class="panel-collapse collapse in">
                        <div class="panel-body">
                            <div class="field-row row-fluid">
                                <div class="col-md-4">
                                    <?php echo form_label(__('Avatar', true), 'avator'); ?>
                                </div>
                                <div class="col-md-8">

                                    <?php $avatar = isset($user->avatar) ? $user->avatar : 'media/users/avatar.png'; ?>
                                    <img src="<?php echo media_url($avatar); ?>" width="32" height="32" alt=".." class="pull-left img-circle"/> 
                                    <?php echo form_upload(array('name' => 'avatar', 'id' => 'profileAvatar')); ?>
                                    <span class="clearfix"></span>

                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <br />
                            <div class="field-row row-fluid">
                                <div class="col-md-4">
                                    <?php echo form_label(__('Address', true), 'address'); ?>
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
                            <br />
                            <div class="field-row row-fluid">
                                <div class="col-md-4">
                                    <?php echo form_label(__('City', true), 'city'); ?>
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

                            <br />
                            <div class="field-row row-fluid">
                                <div class="col-md-4">
                                    <?php
                                    echo form_label(__('State', true), 'state');
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
                            <br />
                            <div class="field-row row-fluid">
                                <div class="col-md-4">
                                    <?php
                                    echo form_label(__('Country', true), 'country');
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
                            <br />
                            <div class="field-row row-fluid">
                                <div class="col-md-4">
                                    <?php
                                    echo form_label(__('Phone', true), 'phone');
                                    ?>
                                </div>
                                <div class="col-md-8">
                                    <?php
                                    echo form_input(array(
                                        'class' => 'form-control',
                                        'name' => 'phone',
                                        'autocomplete' => 'off',
                                        'value' => form_value('phone', $user),
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
                <a href="<?php _u('account'); ?>" class="btn btn-default">
                    <i class="glyphicon glyphicon-circle-arrow-left"></i>
                    <?php __('Cancel'); ?>
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="glyphicon glyphicon-saved"></i>

                    <?php __('Save'); ?>
                </button>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <?php echo form_close(); ?>
</div>


