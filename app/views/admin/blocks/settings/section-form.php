
<section id="main">
    <div class="container-fluid">

        <div class="page-header page-header-block">
            <div class="row-fluid">
                <div class="col-xs-7">
                    <h4 class="title">
                        <span class="fa fa-fw  fa-cog"></span>
                        <?php echo isset($section->title) ? $section->title : lang('New Tab Section'); ?>
                    </h4>
                </div>
                <div class="col-xs-5">
                    <div class="btn-group pull-right">
                        <a href="<?php _u('admin/settings'); ?>" class="btn btn-default btn-sm">
                            <i class="fa fa-arrow-circle-left"></i>
                        </a>
                        <button type="button" class="btn btn-primary  btn-sm click-submit" data-form="#saveSection">
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

            <?php echo form_open('admin/settings/save_section', array('id' => 'saveSection')); ?>
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="field-row">
                        <?php
                        echo form_label(lang('Title'), 'title');
                        echo form_input(array(
                            'class' => 'form-control',
                            'name' => 'title',
                            'value' => isset($section->title) ? $section->title : '',
                        ));
                        ?>
                    </div>
                    <div class="field-row">
                        <?php
                        echo form_label(lang('Access'), 'access[]');
                        echo form_multiselect('access[]', access_A(), isset($section->access) ? explode(',', $section->access) : array(1), 'class="form-control"');
                        ?>
                    </div>
                </div>
                <div class="panel-footer text-right">
                    <?php echo (isset($section->id)) ? form_hidden('id', $section->id) : ''; ?>
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
