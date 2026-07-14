

<section id="main">
    <div class="container-fluid">
        <div class="page-header page-header-block">
            <div class="row-fluid">
                <div class="col-10">
                    <h4 class="title">
                        <i class="fa-solid fa-sliders"></i>
                        <?php __('Content Types'); ?>
                    </h4>
                </div>
                <div class="col-2">
                    <a href="<?php _u('admin/contents/edit_type/-1'); ?>" class="btn btn-primary btn-sm float-end" id="createContentType" data-bs-target="#contentTypeFormModel">
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
                    <?php __('Content Types'); ?>
                    <div class="clearfix"></div>
                </div>
                <div class="card-body">
                    <div class="table">
                        <table class="table table-condensed">
                            <thead>
                                <tr>
                                    <th  class="d-none d-sm-block" ><?php __('ID'); ?></th>
                                    <th><?php __('Name'); ?></th>
                                    <th><?php __('Description'); ?></th>
                                    <th><?php __('Active'); ?></th>
                                    <th class="text-right">
                                        <span class="fa-solid fa-edit"></span>
                                    </th>
                                </tr>
                            </thead>
                            <?php
                            if (count($types)) {
                                foreach ($types as $type) {
                                    ?>
                                    <tr class="<?php echo ($type->system) ? 'active' : ''; ?>">
                                        <td class="d-none d-sm-block"><?php echo $type->id; ?></td>
                                        <td><?php __($type->name); ?></td>
                                        <td><?php __($type->description); ?></td>
                                        <td>
                                            <span class="<?php echo ($type->enabled) ? 'glyphicon-check' : 'glyphicon-unchecked'; ?>"></span>
                                        </td>
                                        <td class="small">
                                            <?php if ((have_permission('contents/edit_type') || have_permission('contents/remove_type')) && !$type->system) : ?>

                                                <div class="dropdown float-end text-left">
                                                    <a data-bs-toggle="dropdown" class="dropdown-toggle cp">
                                                        <span class="fa-solid fa-pencil"></span>
                                                    </a>
                                                    <ul role="menu" class="dropdown-menu dropdown-menu-right">
                                                        <?php if (have_permission('contents/edit_type')) : ?>
                                                            <li>

                                                                <a href="<?php _u('admin/contents/edit_type/' . $type->id); ?>">
                                                                    <span class="fa-solid fa-edit"></span>
                                                                    <?php __('Edit'); ?>
                                                                </a>
                                                            </li>
                                                        <?php endif; ?>
                                                        <?php if (have_permission('contents/remove_type')) : ?>
                                                            <li>

                                                                <a href="<?php _u('admin/contents/remove_type/' . $type->id) ?>" class="remove-box">
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

                <?php
                if ($pagination) {
                    ?>
                    <div class="card-footer">
                        <?php echo $pagination; ?>
                        <div class="clearfix"></div>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>        

</section>


<div class="modal fade" id="contentTypeFormModel" tabindex="-1" role="dialog" aria-labelledby="typesFormModel" aria-hidden="true">
    <div class="modal-dialog modal-sm"><div class="modal-content"></div></div>
</div>
