
<?php echo form_open('admin/contents/save_type', array('id' => 'saveTypeForm')); ?>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title" id="fieldModalLabel"><?php echo isset($type->name) ? $type->name : lang('New Content Type'); ?>
    </h4>
</div>
<div class="modal-body">

    <div class="field-row">
        <?php
        echo form_label(lang('Name'), 'name');
        echo form_input(array(
            'class' => 'form-control',
            'name' => 'name',
            'value' => isset($type->name) ? $type->name : '',
        ));
        ?>    
    </div>
    <div class="field-row hidden">
        <?php
        echo form_label(lang('Alias'), 'alias');
        echo form_input(array(
            'class' => 'form-control',
            'name' => 'alias',
            'value' => isset($type->alias) ? $type->alias : '',
        ));
        ?>    
    </div>
    <div class="field-row">
        <?php
        echo form_label(lang('Description'), 'description');
        echo form_input(array(
            'class' => 'form-control',
            'name' => 'description',
            'value' => isset($type->description) ? $type->description : '',
        ));
        ?>    
    </div>
    <div class="field-row">
        <?php
        echo form_label(lang('Have Category'), 'have_groups');
        echo form_dropdown('have_groups', array('0' => lang('No'), '1' => lang('Yes')), isset($type->have_groups) ? $type->have_groups : 0, 'class="form-control"');
        ?>    
    </div>
    <div class="field-row">
        <?php
        echo form_label(lang('Category Depth'), 'group_depth');
        echo form_dropdown('group_depth', array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9), isset($type->group_depth) ? $type->group_depth : 0, 'class="form-control"');
        ?>    
    </div>
    <div class="field-row">
        <?php
        echo form_label(lang('Enabled'), 'enabled');
        echo form_dropdown('enabled', array('0' => lang('No'), '1' => lang('Yes')), isset($type->enabled) ? $type->enabled : 1, 'class="form-control"');
        ?>    
    </div>
    <div class="field-row">
        <?php
                
        echo form_label(lang('Fieldset'), 'fieldset[]');
        echo form_multiselect('fieldset[]', fieldset_A(), (isset($type->fieldsets)) ? $type->fieldsets : '', 'class="form-control"');
        ?>
    </div>
    <div class="field-row">
        <?php
        echo form_label(lang('Access'), 'access[]');
        echo form_multiselect('access[]', access_A(true), (isset($type->access)) ? explode(',', $type->access) : array(0), 'class="form-control"');
        ?>
    </div>


</div>
<div class="modal-footer">
    <?php echo (isset($type->id)) ? form_hidden('id', $type->id) : ''; ?>
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
       