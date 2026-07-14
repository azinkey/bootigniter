
<section id="main">
    <div class="container-fluid">
        <div class="page-header page-header-block">
            <div class="row-fluid">
                <div class="col-10">
                    <h4 class="title">
                        <i class="fa-solid fa-eye-slash"></i>
                        <?php __('Access'); ?>
                    </h4>
                </div>
                <div class="col-2">
                    <a href="<?php _u('admin/users/edit_access/-1'); ?>" class="btn btn-primary btn-sm float-end edit-box" id="createAccess">
                        <i class="fa-solid fa-plus"></i>
                    </a>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        <?php AZ::block('system-message'); ?>
        <div class="row-fluid">
            <div class="card panel-default">
                <!-- Default panel contents -->
                <div class="card-header">
                    <?php __('User Access Role'); ?>
                    <div class="clearfix"></div>
                </div>
                <div class="card-body">
                    <div class="table">
                        <table class="table table-condensed">
                            <thead>
                                <tr>
                                    <th class="d-none d-sm-block">
                                        <?php __('ID'); ?>
                                    </th>
                                    <th>
                                        <?php __('Access'); ?>
                                    </th>
                                    <th class="text-right"><span class="fa-solid fa-edit"></span></th>
                                </tr>
                            </thead>
                            <?php
                            if (count($accesses)) {
                                foreach ($accesses as $access) {
                                    ?>
                                    <tr class="<?php echo ($access->system) ? 'active' : ''; ?>">
                                        <td class="d-none d-sm-block"><?php echo $access->id; ?></td>
                                        <td><?php echo $access->name; ?></td>
                                        <td class="small">
                                            <?php if ((have_permission('users/edit_access') || have_permission('users/remove_access')) && !$access->system) : ?>

                                                <div class="dropdown float-end text-left">
                                                    <a data-bs-toggle="dropdown" class="dropdown-toggle cp">
                                                        <span class="fa-solid fa-pencil"></span>
                                                    </a>
                                                    <ul role="menu" class="dropdown-menu dropdown-menu-right">
                                                        <?php if (have_permission('users/edit_access')) : ?>
                                                            <li>

                                                                <a href="<?php _u('admin/users/edit_access/' . $access->id); ?>" class="edit-box">
                                                                    <span class="fa-solid fa-edit"></span>
                                                                    <?php __('Edit'); ?>
                                                                </a>
                                                            </li>
                                                        <?php endif; ?>
                                                        <?php if (have_permission('users/remove_access')) : ?>
                                                            <li>

                                                                <a href="<?php _u('admin/users/remove_access/' . $access->id); ?>" class="remove-box">
                                                                    <span class="fa-solid fa-trash"></span>
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
