
<section id="main">
    <div class="container-fluid">

        <div class="page-header page-header-block">
            <div class="row-fluid">
                <div class="col-xs-7">
                    <h4 class="title">
                        <span class="fa fa-fw fa-language"></span>
                        <?php echo isset($language->name) ? $language->name : lang('New Language'); ?>
                    </h4>
                </div>
                <div class="col-xs-5">
                    <div class="btn-group pull-right">
                        <a href="<?php _u('admin/contents/languages'); ?>" class="btn btn-default btn-sm">
                            <i class="fa fa-arrow-circle-left"></i>
                        </a>
                        <button type="button" class="btn btn-primary  btn-sm click-submit" data-form="#saveLanguageForm">
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

            <?php
            echo form_open('admin/contents/save_language', array('id' => 'saveLanguageForm'));
            ?>
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="field-row">
                        <?php
                        echo form_label(lang('Name'), 'name');
                        echo form_input(array(
                            'class' => 'form-control',
                            'name' => 'name',
                            'value' => isset($language->name) ? $language->name : '',
                        ));
                        ?>  
                    </div>
                    <div class="field-row">
                        <?php
                        echo form_label(lang('Code'), 'code');
                        echo form_input(array(
                            'class' => 'form-control',
                            'name' => 'code',
                            'value' => isset($language->code) ? $language->code : '',
                        ));
                        ?>  
                    </div>
                    <div class="field-row">
                        <?php
                        echo form_label(lang('Directory'), 'directory');
                        echo form_input(array(
                            'class' => 'form-control',
                            'name' => 'directory',
                            'value' => isset($language->directory) ? $language->directory : '',
                        ));
                        ?>  
                    </div>
                    <div class="field-row">
                        <?php
                        echo form_label(lang('Default'), 'is_default');
                        echo form_dropdown('is_default', array(0 => lang('No'), 1 => lang('Yes')), isset($language->is_default) ? $language->is_default : 0, 'class="form-control"');
                        ?>  
                    </div>
                    <div class="field-row">
                        <?php
                        echo form_label(lang('Admin'), 'is_admin');
                        echo form_dropdown('is_admin', array(0 => lang('No'), 1 => lang('Yes')), isset($language->is_admin) ? $language->is_admin : 0, 'class="form-control"');
                        ?>  
                    </div>
                    <div class="field-row">
                        <?php
                        echo form_label(lang('Enabled'), 'status');
                        echo form_dropdown('status', array(0 => lang('No'), 1 => lang('Yes')), isset($language->status) ? $language->status : 1, 'class="form-control"');
                        ?>  
                    </div>

                </div>
                <div class="panel-footer text-right">
                    <?php echo (isset($language->id)) ? form_hidden('id', $language->id) : ''; ?>
                    <a href="<?php _u('admin/contents/languages'); ?>" class="btn btn-default btn-sm">
                        <i class="fa fa-arrow-circle-left"></i>
                        <?php __('Cancel'); ?>
                    </a>

                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-save"></i>
                        <?php __('Save'); ?>
                    </button>
                </div>
                <?php
                echo form_close();
                ?>

            </div>


        </div>
</section>       