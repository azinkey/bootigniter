
<?php echo form_open('admin/contents/save_fieldset', array('id' => 'saveFieldset')); ?>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title" id="fieldSetModalLabel">
        <?php echo isset($fieldset->title) ? $fieldset->title : lang('New Field Group'); ?>
    </h4>
</div>
<div class="modal-body">

    <div class="field-row">
        <?php
        echo form_label(lang('Name'), 'name');
        echo form_input(array(
            'class' => 'form-control',
            'name' => 'name',
            'value' => isset($fieldset->name) ? $fieldset->name : '',
        ));
        ?>
    </div>
    <div class="field-row">
        <?php
        echo form_label(lang('Enabled'), 'enabled');
        echo form_dropdown('enabled', array(0 => lang('No'), 1 => lang('Yes')), isset($fieldset->enabled) ? $fieldset->enabled : 1, 'class="form-control"');
        ?>  
    </div>
    <div class="field-row">
        <?php
        echo form_label(lang('Access'), 'access[]');
        echo form_multiselect('access[]', access_A(true), isset($fieldset->access) ? explode(',', $fieldset->access) : array(0), 'class="form-control"');
        ?>
    </div>
</div>
<div class="modal-footer">
    <?php echo (isset($fieldset->id)) ? form_hidden('id', $fieldset->id) : ''; ?>
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
        