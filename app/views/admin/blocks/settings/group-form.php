
<section id="main">
    <div class="container-fluid">

        <div class="page-header page-header-block">
            <div class="row-fluid">
                <div class="col-xs-7">
                    <h4 class="title">
                        <span class="fa fa-fw fa-folder-open"></span>
                        <?php echo isset($group->title) ? $group->title : lang('New Field Group'); ?>
                    </h4>
                </div>
                <div class="col-xs-5">
                    <div class="btn-group pull-right">
                        <a href="<?php _u('admin/settings'); ?>" class="btn btn-default btn-sm">
                            <i class="fa fa-arrow-circle-left"></i>
                        </a>
                        <button type="button" class="btn btn-primary  btn-sm click-submit" data-form="#saveGroup">
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

            <?php echo form_open('admin/settings/save_group', array('id' => 'saveGroup')); ?>
            <div class="panel panel-default">
                <div class="panel-body">

                    <div class="field-row">
                        <?php
                        echo form_label(lang('Title'), 'title');
                        echo form_input(array(
                            'class' => 'form-control',
                            'name' => 'title',
                            'value' => isset($group->title) ? $group->title : '',
                        ));
                        ?>
                    </div>
                    <div class="field-row">
                        <?php
                        echo form_label(lang('Section'), 'sid');
                        echo form_dropdown('sid', $section_A, isset($group->sid) ? $group->sid : 1, 'class="form-control"');
                        ?>
                    </div>
                    <div class="field-row">
                        <?php
                        echo form_label(lang('Access'), 'access[]');
                        echo form_multiselect('access[]', access_A(), isset($group->access) ? explode(',', $group->access) : array(1), 'class="form-control"');
                        ?>
                    </div>


                </div>

                <div class="panel-footer text-right">
                    <?php echo (isset($group->id)) ? form_hidden('id', $group->id) : ''; ?>
                    <a href="<?php _u('admin/settings'); ?>" class="btn btn-default btn-sm">
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
