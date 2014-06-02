

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
                    <a href="<?php _u('admin/contents/edit_group/-1/' . $q); ?>" class="btn btn-primary btn-sm pull-right edit-box" id="createGroups" data-target="#contentGroupFormModel">
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
                            <li class="<?php echo ($id == $q || count($types_A) == 1) ? 'active' : '' ?>">
                                <a href="<?php echo _u('admin/contents/groups/' . $id); ?>" title="<?php echo $name; ?>" >
                                    <i class="fa fa-sliders"></i>
                                    <span class="hidden-xs"> <?php __($name); ?></span>
                                    <span>
                                        <small>
                                            <?php
                                            if (($id == $q)) {
                                                echo '(' . $total_groups . ')';
                                            }
                                            ?>
                                        </small>
                                    </span>
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
                            <div class="tab-pane <?php echo ($id == $q || count($types_A) == 1) ? 'active' : '' ?>" id="section-<?php echo $id; ?>">

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
                                                        <?php
                                                        foreach ($groups as $group) {
                                                            ?>
                                                            <tr class="<?php echo ($group->system) ? 'active' : ''; ?>">
                                                                <td><?php echo $group->name; ?></td>
                                                                <td class="small">
                                                                    <?php if (!$group->system): ?>                                                    

                                                                        <a href="<?php _u('admin/contents/remove_group/' . $group->id . '/' . $id) ?>" class="remove-box action-icon pull-right">
                                                                            <span class="glyphicon glyphicon-trash"></span>
                                                                        </a>
                                                                        <a href="<?php _u('admin/contents/edit_group/' . $group->id . '/' . $id); ?>" data-target="#contentGroupFormModel" class="edit-box action-icon pull-right">
                                                                            <span class="glyphicon glyphicon-edit"></span>
                                                                        </a>

                                                                    <?php endif; ?>


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
                                        <?php if (!empty($pagination)): ?>
                                            <div class="panel-footer">
                                                <div class="col-md-12">
                                                    <?php echo $pagination; ?>
                                                </div>

                                                <div class="clearfix"></div>
                                            </div>
                                        <?php endif; ?>
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
        <?php __('no_record');?>
        <?php endif; ?>
    </div>        

</div>
</section>


<div class="modal fade" id="contentGroupFormModel" tabindex="-1" role="dialog" aria-labelledby="groupFormModel" aria-hidden="true">
    <div class="modal-dialog modal-sm"><div class="modal-content"></div></div>
</div>
