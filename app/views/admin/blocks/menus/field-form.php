
<?php echo form_open('admin/settings/save_setting', array('id' => 'saveSetting')); ?>

<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title" id="fieldModalLabel"><?php
        echo isset($setting->key) ? key_label($setting->key) : lang('New Setting Field');
        ?></h4>
</div>
<div class="modal-body">

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
<div class="modal-footer">
    <?php echo (isset($setting->id)) ? form_hidden('id', $setting->id) : ''; ?>
    <button type="button" class="btn btn-default" data-dismiss="modal">
        <i class="fa fa-arrow-circle-left"></i>
        <?php __('Cancel'); ?>
    </button>
    <button type="submit" class="btn btn-primary">
        <i class="fa fa-save"></i>
        <?php __('Save'); ?>
    </button>
</div>
<?php echo form_close(); ?>


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