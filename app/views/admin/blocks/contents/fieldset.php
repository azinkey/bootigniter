

<section id="main">
    <div class="container-fluid">
        <div class="page-header page-header-block">
            <div class="row-fluid">
                <div class="col-10">
                    <h4 class="title">
                        <i class="fa-solid fa-folder-open"></i>
                        <?php __('Field Set'); ?>
                    </h4>
                </div>
                <div class="col-2">
                    <a href="<?php _u('admin/contents/edit_fieldset/-1'); ?>" class="btn btn-primary btn-sm float-end" id="createFieldSet" data-bs-target="#fieldsetFormModel">
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
                    <?php __('Field Set Group'); ?>
                    <div class="clearfix"></div>
                </div>
                <div class="card-body">
                    <div class="table">
                        <table class="table table-condensed">
                            <thead>
                                <tr>
                                    <th  class="d-none d-sm-block" ><?php __('ID'); ?></th>
                                    <th><?php __('Name'); ?></th>
                                    <th class="text-right"><span class="fa-solid fa-edit"></span></th>
                                </tr>
                            </thead>
                            <?php
                            if (count($fieldsets)) {
                                foreach ($fieldsets as $fieldset) {
                                    ?>
                                    <tr class="<?php echo ($fieldset->system) ? 'active' : ''; ?>">
                                        <td class="d-none d-sm-block"><?php echo $fieldset->id; ?></td>
                                        <td><?php echo $fieldset->name; ?></td>
                                        <td class="small">
                                            <?php if ((have_permission('contents/edit_fieldset') || have_permission('contents/remove_fieldset')) && !$fieldset->system) : ?>

                                                <div class="dropdown float-end text-left">
                                                    <a data-bs-toggle="dropdown" class="dropdown-toggle cp">
                                                        <span class="fa-solid fa-pencil"></span>
                                                    </a>
                                                    <ul role="menu" class="dropdown-menu dropdown-menu-right">
                                                        <?php if (have_permission('contents/edit_fieldset')) : ?>
                                                            <li>

                                                                <a href="<?php _u('admin/contents/edit_fieldset/' . $fieldset->id); ?>">
                                                                    <span class="fa-solid fa-edit"></span>
                                                                    <?php __('Edit'); ?>
                                                                </a>
                                                            </li>
                                                        <?php endif; ?>
                                                        <?php if (have_permission('contents/remove_fieldset')) : ?>
                                                            <li>

                                                                <a href="<?php _u('admin/contents/remove_fieldset/' . $fieldset->id); ?>" class="remove-box">
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

<div class="modal fade" id="fieldsetFormModel" tabindex="-1" role="dialog" aria-labelledby="fieldsetFormModel" aria-hidden="true">
    <div class="modal-dialog modal-sm"><div class="modal-content"></div></div>
</div>
