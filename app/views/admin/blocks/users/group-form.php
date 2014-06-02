
<?php echo form_open('admin/users/save_group', array('id' => 'saveGroupForm')); ?>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title" id="fieldModalLabel"><?php
        echo isset($group->name) ? $group->name : lang('New User Group');
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
            'value' => isset($group->name) ? $group->name : '',
        ));
        ?>
    </div>
    <div class="field-row">
        <?php
        echo form_label(lang('Access'), 'access');
        echo form_dropdown('access', access_A(true), isset($group->access) ? $group->access : 1, 'class="form-control"');
        ?>
    </div>

</div>
<div class="modal-footer">
    <?php echo (isset($group->id)) ? form_hidden('id', $group->id) : ''; ?>
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
       