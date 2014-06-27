

<section id="main">
    <div class="container-fluid">

        <div class="page-header page-header-block">
            <div class="row-fluid">
                <div class="col-xs-7">
                    <h4 class="title">
                        <i class="fa fa-tasks"></i>
                        <?php __('Menus') ?>
                    </h4>
                </div>
                <div class="col-xs-5">
                    <div class="btn-group pull-right">
                        <a href="<?php _u('admin/menus/edit_item/' . $q) ?>" class="btn-primary btn-sm btn" title="<?php __('New Menu Item') ?>">
                            <i class="fa fa-plus"></i>
                        </a>
                        <button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span>
                            <span class="sr-only">^</span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-right" role="menu">
                            <li>
                                <a href="<?php _u('admin/menus/edit_menu') ?>">
                                    <i class="fa fa-tasks fa-fw"></i>
                                    <?php __('New Menu') ?>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>

        <?php AZ::block('system-message'); ?>
        <div class="row-fluid">

            <div class="tabbable tabs-left">
                <ul class="nav nav-tabs">
                    <?php
                    foreach ($menu_A as $id => $name) {
                        $btnClass = ($id == $q) ? 'btn-default' : 'btn-primary';
                        ?>
                        <li class="section-tab <?php echo ($id == $q) ? 'active' : '' ?>">
                            <a href="<?php echo _u('admin/menus/index/' . $id); ?>" title="<?php echo $name; ?>" class="tab-title">
                                <i class="fa fa-bars"></i>
                                <span class="hidden-xs"> <?php __($name); ?></span>

                            </a>
                            <?php if (have_permission('menus/edit_menu') || have_permission('menus/remove_menu')) : ?>

                                <div class="hidden-xs btn-group pull-right m5 <?php echo $btnClass; ?>">

                                    <button data-toggle="dropdown" class="btn btn-sm <?php echo $btnClass; ?> dropdown-toggle" type="button">
                                        <span class="caret"></span>
                                        <span class="sr-only">^</span>
                                    </button>
                                    <ul role="menu" class="dropdown-menu dropdown-menu-right">
                                        <?php if (have_permission('menus/edit_menu')) : ?>
                                            <li>
                                                <a href="<?php _u('admin/menus/edit_menu/' . $id); ?>">
                                                    <span class="glyphicon glyphicon-edit"></span>
                                                    <span class="hidden-xs"><?php __('Edit'); ?></span>
                                                </a>
                                            </li>
                                        <?php endif; ?>
                                        <?php if (have_permission('menus/remove_menu')) : ?>
                                            <li>
                                                <a href="<?php _u('admin/menus/remove_menu/' . $id); ?>" data-target="#modal" class="remove-box">
                                                    <span class="glyphicon glyphicon-trash"></span>
                                                    <span class="hidden-xs"><?php __('Remove'); ?></span>
                                                </a>
                                            </li>
                                        <?php endif; ?>
                                    </ul>

                                </div>
                            <?php endif; ?>

                        </li>
                        <?php
                    }
                    ?>
                </ul>
                <div class="tab-content">
                    <?php foreach ($menu_A as $id => $name) { ?>
                        <div class="tab-pane <?php echo ($id == $q) ? 'active' : '' ?>" id="section-<?php echo $id; ?>">
                            <div class="row-fluid">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <?php __($name); ?>
                                        <span>
                                            <small>
                                                <?php
                                                if (($id == $q)) : echo '(' . $total_items . ')';
                                                endif;
                                                ?>
                                            </small>
                                        </span>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="panel-body">
                                        <div class="table">
                                            <?php if (count($items)) { ?>
                                                <table class="table table-condensed menu-items">
                                                    <thead>
                                                        <tr>
                                                            <th><?php __('Name'); ?></th>
                                                            <th class="text-center">
                                                                <?php __('Status'); ?>
                                                            </th>
                                                            <th class="text-right">
                                                                <span class="glyphicon glyphicon-edit"></span>
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <?php foreach ($items as $item) { ?>
                                                        <tr>
                                                            <td><?php __($item['title']); ?></td>
                                                            <td class="text-center">
                                                                <span class="glyphicon <?php echo ($item['enabled']) ? 'glyphicon-check' : 'glyphicon-unchecked'; ?>"></span>
                                                            </td>
                                                            <td class="small">
                                                                <?php if (have_permission('menus/edit_item') || have_permission('menus/remove_item')) : ?>

                                                                    <div class="dropdown pull-right text-left">
                                                                        <a data-toggle="dropdown" class="dropdown-toggle cp">
                                                                            <span class="glyphicon glyphicon-pencil"></span>
                                                                        </a>
                                                                        <ul role="menu" class="dropdown-menu dropdown-menu-right">
                                                                            <?php if (have_permission('menus/edit_item')) : ?>
                                                                                <li>

                                                                                    <a href="<?php _u('admin/menus/edit_item/' . $q . '/' . $item['id']); ?>">
                                                                                        <span class="glyphicon glyphicon-edit"></span>
                                                                                        <?php __('Edit'); ?>
                                                                                    </a>
                                                                                </li>
                                                                            <?php endif; ?>
                                                                            <?php if (have_permission('menus/remove_item')) : ?>
                                                                                <li>

                                                                                    <a href="<?php _u('admin/menus/remove_item/' . $item['id']); ?>" class="remove-box">
                                                                                        <span class="glyphicon glyphicon-trash"></span>
                                                                                        <?php __('Remove'); ?>
                                                                                    </a>
                                                                                </li>
                                                                            <?php endif; ?>
                                                                        </ul>

                                                                    </div>
                                                                    <?php
                                                                endif;
                                                                ?>

                                                            </td>
                                                        </tr>
                                                    <?php } ?>
                                                </table>
                                                <?php
                                            } else {
                                                echo __('no_record');
                                            }
                                            ?>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>

    </div>
</section>
