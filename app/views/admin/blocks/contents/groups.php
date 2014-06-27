

<section id="main">
    <div class="container-fluid">
        <div class="page-header page-header-block">
            <div class="row-fluid">
                <div class="col-xs-10">
                    <h4 class="title">
                        <i class="fa fa-folder-open-o"></i>
                        <?php __('Content Groups'); ?>
                    </h4>
                </div>
                <div class="col-xs-2">
                    <a href="<?php _u('admin/contents/edit_group/-1/' . $q); ?>" class="btn btn-primary btn-sm pull-right" id="createGroups">
                        <i class="fa fa-plus"></i>
                    </a>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        <?php AZ::block('system-message'); ?>

        <?php if (count($types_A)): ?>
            <div class="row-fluid">
                <div class="tabbable tabs-left">
                    <ul class="nav nav-tabs">
                        <?php
                        foreach ($types_A as $id => $name) {
                            ?>
                            <li class="<?php echo ($id == $q) ? 'active' : '' ?>">
                                <a href="<?php echo _u('admin/contents/groups/' . $id); ?>" title="<?php echo $name; ?>" >
                                    <i class="fa fa-sliders"></i>
                                    <span class="hidden-xs"> <?php __($name); ?></span>
                                </a>
                            </li>
                            <?php
                        }
                        ?>

                    </ul>
                    <div class="tab-content">
                        <?php
                        foreach ($types_A as $id => $name) {
                            ?>
                            <div class="tab-pane <?php echo ($id == $q) ? 'active' : '' ?>" id="section-<?php echo $id; ?>">

                                <div class="row-fluid">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <?php __($name); ?>

                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="panel-body">

                                            <div class="table">
                                                <?php if (count($groups)) { ?>
                                                    <table class="table table-condensed">
                                                        <thead>
                                                            <tr>
                                                                <th><?php __('Name'); ?></th>
                                                                <th class="text-right"><span class="glyphicon glyphicon-edit"></span></th>
                                                            </tr>
                                                        </thead>
                                                        <?php foreach ($groups as $group) { ?>
                                                            <tr class="<?php echo ($group['system']) ? 'active' : ''; ?>">
                                                                <td><?php echo $group['name']; ?></td>
                                                                <td class="small">
                                                                    <?php if ((have_permission('contents/edit_group') || have_permission('contents/remove_group')) && !$group['system']) : ?>

                                                                        <div class="dropdown pull-right text-left">
                                                                            <a data-toggle="dropdown" class="dropdown-toggle cp">
                                                                                <span class="glyphicon glyphicon-pencil"></span>
                                                                            </a>
                                                                            <ul role="menu" class="dropdown-menu dropdown-menu-right">
                                                                                <?php if (have_permission('contents/edit_group')) : ?>
                                                                                    <li>

                                                                                        <a href="<?php _u('admin/contents/edit_group/' . $group['id'] . '/' . $id); ?>">
                                                                                            <span class="glyphicon glyphicon-edit"></span>
                                                                                            <?php __('Edit'); ?>
                                                                                        </a>
                                                                                    </li>
                                                                                <?php endif; ?>
                                                                                <?php if (have_permission('contents/remove_group')) : ?>
                                                                                    <li>

                                                                                        <a href="<?php _u('admin/contents/remove_group/' . $group['id'] . '/' . $id); ?>" class="remove-box">
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
                                                        ?>
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
                            <?php
                        }
                        ?>
                    </div>
                </div>
                <div class="clearfix"></div>

            </div>
        <?php else: ?>
            <?php __('no_record'); ?>
        <?php endif; ?>
    </div>        

</div>
</section>


<div class="modal fade" id="contentGroupFormModel" tabindex="-1" role="dialog" aria-labelledby="groupFormModel" aria-hidden="true">
    <div class="modal-dialog modal-sm"><div class="modal-content"></div></div>
</div>
