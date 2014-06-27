

<section id="main">
    <div class="container-fluid">
        <div class="page-header page-header-block">
            <div class="row-fluid">
                <div class="col-xs-10">
                    <h4 class="title">
                        <i class="fa fa-users"></i>
                        <?php __('User Groups'); ?>
                    </h4>
                </div>
                <div class="col-xs-2">
                    <a href="<?php _u('admin/users/edit_group/-1'); ?>" class="btn btn-primary btn-sm pull-right" id="createGroup" data-target="#groupFormModel">
                        <i class="fa fa-plus"></i>
                    </a>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        <?php AZ::block('system-message'); ?>
        <div class="row-fluid">

            <div class="panel panel-default">
                <!-- Default panel contents -->
                <div class="panel-heading">
                    <span class="glyphicon glyphicon-asterisk"></span>
                    <?php __('User Groups'); ?>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-body">
                    <div class="table">
                        <table class="table table-condensed">
                            <thead>
                                <tr>
                                    <th class="hidden-xs">
                                        <?php __('ID'); ?>
                                    </th>
                                    <th>
                                        <?php __('Name'); ?>
                                    </th>
                                    <th>
                                        <?php __('Access'); ?>
                                    </th>
                                    <th class="text-right"><span class="glyphicon glyphicon-edit"></span></th>
                                </tr>
                            </thead>
                            <?php
                            if (count($groups)) {
                                foreach ($groups as $group) {
                                    ?>
                                    <tr class="<?php echo ($group->system) ? 'active' : ''; ?>">
                                        <td class="hidden-xs"><?php echo $group->id; ?></td>
                                        <td><?php echo $group->name; ?></td>
                                        <td><?php echo $group->role; ?></td>
                                        <td class="small">
                                            <?php if ((have_permission('users/edit_group') || have_permission('users/remove_group')) && !$group->system) : ?>

                                                <div class="dropdown pull-right text-left">
                                                    <a data-toggle="dropdown" class="dropdown-toggle cp">
                                                        <span class="glyphicon glyphicon-pencil"></span>
                                                    </a>
                                                    <ul role="menu" class="dropdown-menu dropdown-menu-right">
                                                        <?php if (have_permission('users/edit_group')) : ?>
                                                            <li>

                                                                <a href="<?php _u('admin/users/edit_group/' . $group->id); ?>">
                                                                    <span class="glyphicon glyphicon-edit"></span>
                                                                    <?php __('Edit'); ?>
                                                                </a>
                                                            </li>
                                                        <?php endif; ?>
                                                        <?php if (have_permission('users/remove_group')) : ?>
                                                            <li>

                                                                <a href="<?php _u('admin/users/remove_group/' . $group->id); ?>" class="remove-box">
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
                                    <?php
                                }
                            }
                            ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>        
    </div>
</section>

<div class="modal fade" id="groupFormModel" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm"><div class="modal-content"></div></div>
</div>
