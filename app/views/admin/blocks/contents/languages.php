

<section id="main">
    <div class="container-fluid">
        <div class="page-header page-header-block">
            <div class="row-fluid">
                <div class="col-10">
                    <h4 class="title">
                        <i class="fa-solid fa-language"></i>
                        <?php __('Languages'); ?>
                    </h4>
                </div>
                <div class="col-2">
                    <a href="<?php _u('admin/contents/edit_language/-1'); ?>" class="btn btn-primary btn-sm float-end" id="createLanguage" data-bs-target="#languageFormModel" title="<?php __('Add New'); ?>" >
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
                    <span class="fa-solid fa-globe"></span>
                    <?php __('Languages'); ?>
                    <div class="clearfix"></div>
                </div>
                <div class="card-body">
                    <div class="table">
                        <table class="table table-condensed">
                            <thead>
                                <tr>
                                    <th  class="d-none d-sm-block" ><?php __('ID'); ?></th>
                                    <th><?php __('Name'); ?></th>
                                    <th  class="d-none d-sm-block" ><?php __('Directory'); ?></th>
                                    <th  class="d-none d-sm-block" ><?php __('Code'); ?></th>
                                    <th><?php __('Admin'); ?></th>
                                    <th><?php __('Default'); ?></th>
                                    <th class="text-right"><span class="fa-solid fa-edit"></span></th>
                                </tr>
                            </thead>
                            <?php
                            if (count($languages)) {
                                foreach ($languages as $language) {
                                    ?>
                                    <tr class="<?php echo ($language->system) ? 'active' : ''; ?>">
                                        <td class="d-none d-sm-block"><?php echo $language->id; ?></td>
                                        <td><?php echo $language->name; ?></td>
                                        <td  class="d-none d-sm-block" ><?php echo $language->directory; ?></td>
                                        <td  class="d-none d-sm-block" ><?php echo $language->code; ?></td>
                                        <td>
                                            <span class="<?php echo ($language->is_admin) ? 'glyphicon-check' : 'glyphicon-unchecked'; ?>"></span>
                                        </td>
                                        <td>
                                            <span class="<?php echo ($language->is_default) ? 'glyphicon-check' : 'glyphicon-unchecked'; ?>"></span>
                                        </td>

                                        <td class="small">
                                            <?php if ((have_permission('contents/edit_language') || have_permission('contents/remove_language')) && !$language->system) : ?>

                                                <div class="dropdown float-end text-left">
                                                    <a data-bs-toggle="dropdown" class="dropdown-toggle cp">
                                                        <span class="fa-solid fa-pencil"></span>
                                                    </a>
                                                    <ul role="menu" class="dropdown-menu dropdown-menu-right">
                                                        <?php if (have_permission('contents/edit_language')) : ?>
                                                            <li>

                                                                <a href="<?php _u('admin/contents/edit_language/' . $language->id); ?>">
                                                                    <span class="fa-solid fa-edit"></span>
                                                                    <?php __('Edit'); ?>
                                                                </a>
                                                            </li>
                                                        <?php endif; ?>
                                                        <?php if (have_permission('contents/remove_language')) : ?>
                                                            <li>

                                                                <a href="<?php _u('admin/contents/remove_language/' . $language->id) ?>" class="remove-box">
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


<div class="modal fade" id="languageFormModel" tabindex="-1" role="dialog" aria-labelledby="languageFormModel" aria-hidden="true">
    <div class="modal-dialog modal-sm"><div class="modal-content"></div></div>
</div>
