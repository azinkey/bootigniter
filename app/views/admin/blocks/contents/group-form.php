
<?php echo form_open('admin/contents/save_group', array('id' => 'saveContentGroupForm')); ?>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title" id="fieldModalLabel"><?php echo isset($group->name) ? $group->name : lang('New Group'); ?>
    </h4>
</div>
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
            <option value="0"><?php __('Root');?></option>
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
        echo form_multiselect('access[]', access_A(true), (isset($group->access)) ? explode(',', $group->access) : array(0), 'class="form-control"');
        ?>
    </div>
</div>
<div class="modal-footer">
    <?php echo (isset($group->id)) ? form_hidden('id', $group->id) : ''; ?>
    <?php echo (isset($type)) ? form_hidden('type', $type) : ''; ?>
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
       