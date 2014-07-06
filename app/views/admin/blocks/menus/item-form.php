
<section id="main">
    <div class="container-fluid">

        <div class="page-header page-header-block">
            <div class="row-fluid">
                <div class="col-xs-7">
                    <h4 class="title">
                        <span class="glyphicon glyphicon-link"></span>
                        <?php echo (isset($item->title)) ? $item->title : __('New Menu Item', true); ?>
                    </h4>
                </div>
                <div class="col-xs-5">
                    <div class="btn-group pull-right">
                        <a href="<?php _u('admin/menus/index/' . $menu_id); ?>" class="btn btn-default btn-sm">
                            <i class="fa fa-arrow-circle-left"></i>
                        </a>
                        <button type="button" class="btn btn-primary  btn-sm click-submit" data-form="#saveMenuItem">
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

            <?php echo form_open('admin/menus/save_item', array('id' => 'saveMenuItem')); ?>
            <div class="panel panel-default">
                <div class="panel-body">
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
                            echo form_dropdown('menu_type', array('Link', 'Path', 'Content', 'Groups', 'HTML'), isset($item->menu_type) ? $item->menu_type : 0, ' id="menuType" class="form-control"');
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
                            echo form_label(__('Content Types', true), 'content_type');
                            echo form_dropdown('content_type_2', contents_A(), (isset($item->content_type)) ? $item->content_type : 0, 'class="form-control" id="contentType"');
                            ?>
                        </div>
                        <div class="field-row menu_type_field hidden-row" id="menu_type_3">
                            <?php
                            echo form_label(__('Content Types', true), 'contents');
                            echo form_dropdown('content_type_3', contents_A(true), (isset($item->content_type)) ? $item->content_type : 0, 'class="form-control" id="contentTypeGroup"');
                            ?>
                        </div>
                        <div class="field-row menu_type_field hidden-row" id="menu_type_4">
                            <?php
                            echo form_label(__('Content Block', true), 'content');
                            echo form_textarea(array(
                                'class' => 'form-control ckeditor',
                                'name' => 'content',
                                'value' => isset($item->content) ? $item->content : '',
                            ));
                            ?>
                        </div>
                        <div class="field-row" id="contentsBox" data-content="<?php echo (isset($item->content_id)) ? $item->content_id : 0; ?>">

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
                </div>
                <div class="panel-footer text-right">
                    <?php echo (isset($item->id)) ? form_hidden('id', $item->id) : ''; ?>
                    <?php echo (isset($menu_id)) ? form_hidden('menu_id', $menu_id) : ''; ?>
                    <a href="<?php _u('admin/menus/index/' . $menu_id); ?>" class="btn btn-default btn-sm">
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

            var menuType = $("#menuType");
            var type = menuType.val();

            var contentType = $("#contentType");
            var contentTypeGroup = $("#contentTypeGroup");

            var contentId = $("#contentsBox").data('content');

            var type_id = contentTypeGroup.val();
            console.log('type_id ', type_id);
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
                    $("#contentsBox").load(site_url + 'admin/menus/get_contents/' + type_id + '/' + contentId);
                } else {
                    $("#contentsBox").text('');
                }
            });
            contentTypeGroup.change(function() {
                console.log('asdf', contentTypeGroup.val());
                if (type_id > 0) {
                    $("#contentsBox").load(site_url + 'admin/menus/get_groups/' + type_id + '/' + contentId);
                } else {
                    $("#contentsBox").text('');
                }
            });

            if (type == 2) {
                $("#contentsBox").load(site_url + 'admin/menus/get_contents/' + contentType.val() + '/' + contentId);
            }
            if (type == 3 && (type_id > 0)) {
                $("#contentsBox").load(site_url + 'admin/menus/get_groups/' + type_id + '/' + contentId);
            }



        });
    })(jQuery);
</script>