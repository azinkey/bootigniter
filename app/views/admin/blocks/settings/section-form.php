
<?php echo form_open('admin/settings/save_section', array('id' => 'saveSection')); ?>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title" id="fieldModalLabel">
        <?php echo isset($section->title) ? $section->title : lang('New Tab Section'); ?>

    </h4>
</div>
<div class="modal-body">

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
<div class="modal-footer">
    <?php echo (isset($section->id)) ? form_hidden('id', $section->id) : ''; ?>
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
        