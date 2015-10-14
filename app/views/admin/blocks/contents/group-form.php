
<section id="main">
    <div class="container-fluid">

        <div class="page-header page-header-block">
            <div class="row-fluid">
                <div class="col-xs-7">
                    <h4 class="title">
                        <span class="fa fa-folder-open-o"></span>
                        <?php echo isset($group->name) ? $group->name : lang('New Group'); ?>
                    </h4>
                </div>
                <div class="col-xs-5">
                    <div class="btn-group pull-right">
                        <a href="<?php _u('admin/contents/groups/' . $type); ?>" class="btn btn-default btn-sm">
                            <i class="fa fa-arrow-circle-left"></i>
                        </a>
                        <button type="button" class="btn btn-primary  btn-sm click-submit" data-form="#saveContentGroupForm" data-return="<?php _u('admin/contents/edit_group/-1/' . $type); ?>">
                            <i class="glyphicon glyphicon-saved"></i>
                            <i class="glyphicon glyphicon-plus"></i>
                        </button>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        <?php AZ::block('system-message'); ?>
        <div class="row-fluid">


            <?php echo form_open('admin/contents/save_group', array('id' => 'saveContentGroupForm')); ?>
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="modal-body">
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
                        <div class="field-row hidden">
                            <?php
                            echo form_label(lang('Alias'), 'alias');
                            echo form_input(array(
                                'class' => 'form-control',
                                'name' => 'alias',
                                'value' => isset($group->alias) ? $group->alias : '',
                            ));
                            ?>    
                        </div>
                        <div class="field-row hidden">
                            <?php
                            echo form_label(lang('Description'), 'description');
                            echo form_input(array(
                                'class' => 'form-control',
                                'name' => 'description',
                                'value' => isset($group->description) ? $group->description : '',
                            ));
                            ?>    
                        </div>
                        <div class="field-row">
                            <?php echo form_label(lang('Parent'), 'parent'); ?>    
                            <select class="form-control" name="parent">
                                <option value="0"><?php __('Root'); ?></option>
                                <?php echo $parentsOption; ?>
                            </select>
                        </div>
                        <div class="field-row">
                            <?php
                            echo form_label(lang('Enabled'), 'enabled');
                            echo form_dropdown('enabled', array('0' => lang('No'), '1' => lang('Yes')), isset($group->enabled) ? $group->enabled : 1, 'class="form-control"');
                            ?>    
                        </div>
                        <div class="field-row">
                            <?php
                            echo form_label(lang('Access'), 'access[]');
                            echo form_multiselect('access[]', access_A(true), (isset($group->access)) ? explode(',', $group->access) : array(0, 1, 2, 3, 4, 5), 'class="form-control"');
                            ?>
                        </div>
                    </div>
                    <div class="panel-footer text-right">
                        <?php echo form_hidden('id', (isset($group->id)) ? $group->id : -1); ?>
                        <?php echo (isset($type)) ? form_hidden('type', $type) : ''; ?>
                        <a href="<?php _u('admin/contents/groups/' . $type); ?>" class="btn btn-default btn-sm">
                            <i class="fa fa-arrow-circle-left"></i>
                            <?php __('Cancel'); ?>
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-save"></i>
                            <?php __('Save'); ?>
                        </button>
                    </div>

                    <?php echo form_close(); ?>

                </div>


            </div>
            </section>
