
<section id="main">
    <div class="container-fluid">
        <div class="page-header page-header-block">
            <div class="row-fluid">
                <div class="col-xs-7">
                    <h4 class="title">
                        <i class="fa fa-users"></i>
                        <?php echo isset($group->name) ? $group->name : lang('New User Group'); ?>
                    </h4>
                </div>
                <div class="col-xs-5">
                    <div class="btn-group pull-right">
                        <a href="<?php _u('admin/users/groups'); ?>" class="btn btn-default btn-sm">
                            <i class="fa fa-arrow-circle-left"></i>
                        </a>
                        <button type="button" class="btn btn-primary  btn-sm click-submit" data-form="#saveGroupForm">
                            <i class="fa fa-save"></i>
                        </button>
                    </div>
                    <div class="clearfix"></div>
                </div>

            </div><div class="clearfix"></div>

        </div>
        <?php AZ::block('system-message'); ?>
        <div class="row-fluid">

            <?php echo form_open('admin/users/save_group', array('id' => 'saveGroupForm')); ?>
            <div class="panel panel-default">
                <div class="panel-body">

                    <div class="field-row">
                        <?php
                        echo form_label(lang('Name'), 'name');
                        echo form_input(array(
                            'class' => 'form-control',
                            'name' => 'name',
                            'value' => isset($group->name) ? $group->name : '',
                        ));
                        ?>
                    </div>
                    <div class="field-row">
                        <?php
                        echo form_label(lang('Access'), 'access');
                        echo form_dropdown('access', access_A(true), isset($group->access) ? $group->access : 1, 'class="form-control"');
                        ?>
                    </div>

                </div>
                <div class="panel-footer text-right">
                    <?php echo (isset($group->id)) ? form_hidden('id', $group->id) : ''; ?>
                    <a href="<?php _u('admin/users/groups'); ?>" class="btn btn-default">
                            <i class="fa fa-arrow-circle-left"></i>
                            <?php __('Cancel'); ?>
                        </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-save"></i>
                        <?php __('Save'); ?>
                    </button>
                </div>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</section>       