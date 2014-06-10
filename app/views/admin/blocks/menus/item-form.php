
<?php echo form_open('admin/menus/save_item', array('id' => 'saveMenuItem')); ?>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title" id="fieldModalLabel">
        <?php echo (isset($item->title)) ? $item->title : __('New Menu Item', true); ?>

    </h4>
</div>
<div class="modal-body">

    <div class="field-row">
        <?php
        echo form_label(__('Title', true), 'title');
        echo form_input(array(
            'class' => 'form-control',
            'name' => 'title',
            'value' => isset($item->title) ? $item->title : '',
        ));
        ?>
    </div>
    <div class="field-row">
        <?php
        echo form_label(__('Parent', true), 'parent');
        ?>
        <select name="parent" class="form-control">
            <option value="0"><?php __('Root'); ?></option>
            <?php echo menuOptionTree($menu_id, 0, isset($item->parent) ? $item->parent : 0); ?>
        </select>
    </div>
    <div class="field-row">
        <?php
        echo form_label(__('Menu Type', true), 'menu_type');
        echo form_dropdown('menu_type', array('Link', 'Path', 'Content','Groups'), isset($item->menu_type) ? $item->menu_type : 0, ' id="menuType" class="form-control"');
        ?>
    </div>
    <div class="field-row menu_type_field hidden-row" id="menu_type_0">
        <?php
        echo form_label(__('Link', true), 'link');
        echo form_input(array(
            'class' => 'form-control',
            'name' => 'link',
            'placeholder' => 'http://',
            'value' => isset($item->link) ? $item->link : '',
        ));
        ?> 
    </div>
    <div class="field-row menu_type_field hidden-row" id="menu_type_1">
        <?php
        echo form_label(__('Path', true), 'path');
        echo form_input(array(
            'class' => 'form-control',
            'name' => 'path',
            'placeholder' => 'controller/method/param',
            'value' => isset($item->path) ? $item->path : '',
        ));
        ?>
    </div>
    <div class="field-row menu_type_field hidden-row" id="menu_type_2">
        <?php
        echo form_label(__('Content Types', true), 'contents');
        echo form_dropdown('contents', contents_A(), 0, 'class="form-control" id="contentType"');
        ?>
    </div>
    <div class="field-row menu_type_field hidden-row" id="menu_type_3">
        <?php
        echo form_label(__('Content Types', true), 'contents');
        echo form_dropdown('contents', contents_A(true), 0, 'class="form-control" id="contentTypeGroup"');
        ?>
    </div>
    <div class="field-row" id="contentsBox">

    </div>
    <div class="field-row">
        <?php
        echo form_label(__('Enabled', true), 'enabled');
        echo form_dropdown('enabled', array('0' => lang('No'), '1' => lang('Yes')), isset($item->enabled) ? $item->enabled : 1, 'class="form-control"');
        ?>
    </div>
    <div class="field-row">
        <?php
        echo form_label(__('Access', true), 'access[]');
        $accessOptions = access_A(true);
        echo form_multiselect('access[]', access_A(true), isset($item->access) ? explode(',', $item->access) : array_keys($accessOptions), 'class="form-control"');
        ?>
    </div>



</div>
<div class="modal-footer">
    <?php echo (isset($item->id)) ? form_hidden('id', $item->id) : ''; ?>
    <?php echo (isset($menu_id)) ? form_hidden('menu_id', $menu_id) : ''; ?>
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
            
            var menuType = $("#menuType");
            var contentType = $("#contentType");
            var contentTypeGroup = $("#contentTypeGroup");
            var type = menuType.val();
            var site_url = $('meta[name="site_url"]').attr('content');
            
            $("#menu_type_" + type).removeClass('hidden-row');
            menuType.change(function() {
                $(".menu_type_field").each(function() {
                    $(this).addClass('hidden-row');
                });
                type = menuType.val();
                $("#menu_type_" + type).removeClass('hidden-row');
                
                if (type !== 2) {
                    $("#contentsBox").text('');
                    contentType.val(0);
                }
                
            });
            contentType.change(function() {
                var type_id = contentType.val();
                if (type_id > 0) {
                    $("#contentsBox").load(site_url + 'admin/menus/get_contents/' + type_id);
                } else {
                    $("#contentsBox").text('');
                }
            });
            contentTypeGroup.change(function() {
                var type_id = contentTypeGroup.val();
                if (type_id > 0) {
                    $("#contentsBox").load(site_url + 'admin/menus/get_groups/' + type_id);
                } else {
                    $("#contentsBox").text('');
                }
            });
        });
    })(jQuery);
</script>