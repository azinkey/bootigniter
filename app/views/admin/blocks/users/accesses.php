
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
                    <a href="<?php _u('admin/users/edit_access/-1'); ?>" class="btn btn-primary btn-sm pull-right edit-box" id="createAccess">
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
                                            <?php if ((have_permission('users/edit_access') || have_permission('users/remove_access')) && !$access->system) : ?>

                                                <div class="dropdown pull-right text-left">
                                                    <a data-toggle="dropdown" class="dropdown-toggle cp">
                                                        <span class="glyphicon glyphicon-pencil"></span>
                                                    </a>
                                                    <ul role="menu" class="dropdown-menu dropdown-menu-right">
                                                        <?php if (have_permission('users/edit_access')) : ?>
                                                            <li>

                                                                <a href="<?php _u('admin/users/edit_access/' . $access->id); ?>" class="edit-box">
                                                                    <span class="glyphicon glyphicon-edit"></span>
                                                                    <?php __('Edit'); ?>
                                                                </a>
                                                            </li>
                                                        <?php endif; ?>
                                                        <?php if (have_permission('users/remove_access')) : ?>
                                                            <li>

                                                                <a href="<?php _u('admin/users/remove_access/' . $access->id); ?>" class="remove-box">
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
