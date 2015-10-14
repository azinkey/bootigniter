
<section id="main">
    <div class="container-fluid">

        <div class="page-header page-header-block">
            <div class="row-fluid">
                <div class="col-xs-7">
                    <h4 class="title">
                        <span class="fa fa-ellipsis-h fa-fw"></span>
                        <?php echo isset($setting->key) ? key_label($setting->key) : lang('New Field'); ?>
                    </h4>
                </div>
                <div class="col-xs-5">
                    <div class="btn-group pull-right">
                        <a href="<?php _u('admin/settings'); ?>" class="btn btn-default btn-sm">
                            <i class="fa fa-arrow-circle-left"></i>
                        </a>
                        <button type="button" class="btn btn-primary  btn-sm click-submit" data-form="#saveSetting">
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

            <?php echo form_open('admin/settings/save_setting', array('id' => 'saveSetting')); ?>

            <div class="panel panel-default">
                <div class="panel-body">


                    <div class="field-row">
                        <?php
                        echo form_label(lang('Key'), 'key');
                        echo form_input(array(
                            'class' => 'form-control',
                            'name' => 'key',
                            'value' => isset($setting->key) ? $setting->key : '',
                        ));
                        ?>
                        <small><?php __('use lowercase without space or special character.'); ?></small>
                    </div>
                    <div class="field-row">
                        <?php
                        echo form_label(lang('Value'), 'value');
                        echo form_input(array(
                            'class' => 'form-control',
                            'name' => 'value',
                            'value' => isset($setting->value) ? $setting->value : '',
                        ));
                        ?>
                    </div>

                    <div class="field-row">
                        <?php
                        echo form_label(lang('Field Group'), 'group_id');
                        echo form_dropdown('group_id', $group_A, '', 'class="form-control"');
                        ?>
                    </div>

                    <div class="field-row">
                        <?php
                        echo form_label(lang('Type'), 'type');
                        $disabled = (isset($setting->id) && $setting->id > 0) ? ' disabled="disabled" ' : '';
                        echo form_dropdown('type', field_types(true), isset($setting->type) ? $setting->type : 'text', 'class="form-control" id="settingFieldType"' . $disabled);
                        ?>
                    </div>
                    <hr />
                    <div class="field-row" class="">
                        <h4 class="panel-title cp" id="optionToggle" data-toggle="#settingFieldOptionsWrapper">
                            <i class="fa fa-list-ul"></i> <?php __('Options'); ?>
                        </h4>
                        <br />
                        <div id="settingFieldOptionsWrapper" class="panel-body" data-field="<?php echo (isset($setting->id)) ? $setting->id : ''; ?>">
                            <?php echo field_options((isset($setting->type)) ? $setting->type : 'text', (isset($setting->id)) ? $setting->id : '', true); ?>
                        </div>
                    </div>
                </div>
                <div class="panel-footer text-right">
                    <?php echo (isset($setting->id)) ? form_hidden('id', $setting->id) : ''; ?>
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

<script>

    (function($) {
        $(document).ready(function() {
            var fieldType = $("#settingFieldType").val();
            var wrapper = $("#settingFieldOptionsWrapper");
            var site_url = $('meta[name="site_url"]').attr('content');
            if (fieldType !== 'text') {
                var param = (wrapper.data('field') > 0) ? fieldType + '/' + wrapper.data('field') : fieldType;
                wrapper.load(site_url + 'admin/settings/field_type_options/' + param);
            }
            $("#settingFieldType").change(function() {
                var fieldType = $("#settingFieldType").val();
                var param = (wrapper.data('field') > 0) ? fieldType + '/' + wrapper.data('field') : fieldType;
                wrapper.load(site_url + 'admin/settings/field_type_options/' + param);
            });
        });
    })(jQuery);

</script>