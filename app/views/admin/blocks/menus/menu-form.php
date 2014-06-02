
<?php echo form_open('admin/menus/save_menu', array('id' => 'saveMenu')); ?>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title" id="fieldModalLabel">
        <?php echo (isset($menu->name)) ? $menu->name : __('New Menu',true); ?>
    </h4>
</div>
<div class="modal-body">

    <div class="field-row">
        <?php
        echo form_label(lang('Name'), 'name');
        echo form_input(array(
            'class' => 'form-control',
            'name' => 'name',
            'value' => isset($menu->name) ? $menu->name : '',
        ));
        ?>
    </div>
    <div class="field-row">
        <?php
        echo form_label(lang('Description'), 'description');
        echo form_textarea(array(
            'class' => 'form-control',
            'name' => 'description',
            'rows' => '2',
            'value' => isset($menu->description) ? $menu->description : '',
        ));
        ?>
    </div>
    <div class="field-row">
        <?php
        echo form_label(lang('Access'), 'access[]');
        echo form_multiselect('access[]', access_A(true), isset($menu->access) ? explode(',', $menu->access) : array(0), 'class="form-control"');
        ?>
    </div>


</div>
<div class="modal-footer">
    <?php echo (isset($menu->id)) ? form_hidden('id', $menu->id) : ''; ?>
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
        