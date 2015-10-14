
<section id="main">
    <div class="container-fluid">

        <div class="page-header page-header-block">
            <div class="row-fluid">
                <div class="col-xs-7">
                    <h4 class="title">
                        <span class="glyphicon glyphicon-tasks"></span>
                        <?php echo (isset($item->title)) ? $item->title : __('New Menu Item', true); ?>
                    </h4>
                </div>
                <div class="col-xs-5">
                    <div class="btn-group pull-right">
                        <a href="<?php _u('admin/menus'); ?>" class="btn btn-default btn-sm">
                            <i class="fa fa-arrow-circle-left"></i>
                        </a>
                        <button type="button" class="btn btn-primary  btn-sm click-submit" data-form="#saveMenu">
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

            <?php echo form_open('admin/menus/save_menu', array('id' => 'saveMenu')); ?>
            <div class="panel panel-default">

                <div class="panel-body">

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
                        echo form_input(array(
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
                <div class="panel-footer text-right">
                    <?php echo (isset($menu->id)) ? form_hidden('id', $menu->id) : ''; ?>
                    <a href="<?php _u('admin/menus'); ?>" class="btn btn-default">
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