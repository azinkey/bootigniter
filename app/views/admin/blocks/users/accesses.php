
<section id="main">
    <div class="container-fluid">
        <div class="page-header page-header-block">
            <div class="row-fluid">
                <div class="col-xs-10">
                    <h4 class="title">
                        <i class="fa fa-eye-slash"></i>
                        <?php __('Access'); ?>
                    </h4>
                </div>
                <div class="col-xs-2">
                    <a href="<?php _u('admin/users/edit_access/-1'); ?>" class="btn btn-primary btn-sm pull-right edit-box" id="createAccess" data-target="#accessFormModel">
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
                    <?php __('User Access Role'); ?>
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
                                        <?php __('Access'); ?>
                                    </th>
                                    <th class="text-right"><span class="glyphicon glyphicon-edit"></span></th>
                                </tr>
                            </thead>
                            <?php
                            if (count($accesses)) {
                                foreach ($accesses as $access) {
                                    ?>
                                    <tr class="<?php echo ($access->system) ? 'active' : ''; ?>">
                                        <td class="hidden-xs"><?php echo $access->id; ?></td>
                                        <td><?php echo $access->name; ?></td>
                                        <td class="small">
                                            <?php if (!$access->system): ?>                                                    

                                                <a href="<?php _u('admin/users/remove_access/' . $access->id) ?>" class="remove-box action-icon pull-right">
                                                    <span class="glyphicon glyphicon-trash"></span>
                                                </a>
                                                <a href="<?php _u('admin/users/edit_access/' . $access->id) ?>" data-target="#accessFormModel" class="edit-box action-icon pull-right">
                                                    <span class="glyphicon glyphicon-edit"></span>
                                                </a>

                                            <?php endif; ?>


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


<div class="modal fade" id="accessFormModel" tabindex="-1" role="dialog" aria-labelledby="accessFormModel" aria-hidden="true">
    <div class="modal-dialog modal-sm"><div class="modal-content"></div></div>
</div>
