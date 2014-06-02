
<?php echo form_open('admin/users/save_access', array('id' => 'saveAccessForm')); ?>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title" id="fieldModalLabel"><?php
        echo isset($access->name) ? $access->name : lang('New Access Role');
        ?>
    </h4>
</div>
<div class="modal-body">
    <div class="field-row">
        <?php
        echo form_label(lang('Name'), 'name');
        echo form_input(array(
            'class' => 'form-control',
            'name' => 'name',
            'value' => isset($access->name) ? $access->name : '',
        ));
        ?>
    </div>
</div>
<div class="modal-footer">
    <?php echo (isset($access->id)) ? form_hidden('id', $access->id) : ''; ?>
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
       