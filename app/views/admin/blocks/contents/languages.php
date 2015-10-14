

<section id="main">
    <div class="container-fluid">
        <div class="page-header page-header-block">
            <div class="row-fluid">
                <div class="col-xs-10">
                    <h4 class="title">
                        <i class="fa fa-language"></i>
                        <?php __('Languages'); ?>
                    </h4>
                </div>
                <div class="col-xs-2">
                    <a href="<?php _u('admin/contents/edit_language/-1'); ?>" class="btn btn-primary btn-sm pull-right" id="createLanguage" data-target="#languageFormModel" title="<?php __('Add New'); ?>" >
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
                    <span class="glyphicon glyphicon-globe"></span>
                    <?php __('Languages'); ?>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-body">
                    <div class="table">
                        <table class="table table-condensed">
                            <thead>
                                <tr>
                                    <th  class="hidden-xs" ><?php __('ID'); ?></th>
                                    <th><?php __('Name'); ?></th>
                                    <th  class="hidden-xs" ><?php __('Directory'); ?></th>
                                    <th  class="hidden-xs" ><?php __('Code'); ?></th>
                                    <th><?php __('Admin'); ?></th>
                                    <th><?php __('Default'); ?></th>
                                    <th class="text-right"><span class="glyphicon glyphicon-edit"></span></th>
                                </tr>
                            </thead>
                            <?php
                            if (count($languages)) {
                                foreach ($languages as $language) {
                                    ?>
                                    <tr class="<?php echo ($language->system) ? 'active' : ''; ?>">
                                        <td class="hidden-xs"><?php echo $language->id; ?></td>
                                        <td><?php echo $language->name; ?></td>
                                        <td  class="hidden-xs" ><?php echo $language->directory; ?></td>
                                        <td  class="hidden-xs" ><?php echo $language->code; ?></td>
                                        <td>
                                            <span class="glyphicon <?php echo ($language->is_admin) ? 'glyphicon-check' : 'glyphicon-unchecked'; ?>"></span>
                                        </td>
                                        <td>
                                            <span class="glyphicon <?php echo ($language->is_default) ? 'glyphicon-check' : 'glyphicon-unchecked'; ?>"></span>
                                        </td>

                                        <td class="small">
                                            <?php if ((have_permission('contents/edit_language') || have_permission('contents/remove_language')) && !$language->system) : ?>

                                                <div class="dropdown pull-right text-left">
                                                    <a data-toggle="dropdown" class="dropdown-toggle cp">
                                                        <span class="glyphicon glyphicon-pencil"></span>
                                                    </a>
                                                    <ul role="menu" class="dropdown-menu dropdown-menu-right">
                                                        <?php if (have_permission('contents/edit_language')) : ?>
                                                            <li>

                                                                <a href="<?php _u('admin/contents/edit_language/' . $language->id); ?>">
                                                                    <span class="glyphicon glyphicon-edit"></span>
                                                                    <?php __('Edit'); ?>
                                                                </a>
                                                            </li>
                                                        <?php endif; ?>
                                                        <?php if (have_permission('contents/remove_language')) : ?>
                                                            <li>

                                                                <a href="<?php _u('admin/contents/remove_language/' . $language->id) ?>" class="remove-box">
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


<div class="modal fade" id="languageFormModel" tabindex="-1" role="dialog" aria-labelledby="languageFormModel" aria-hidden="true">
    <div class="modal-dialog modal-sm"><div class="modal-content"></div></div>
</div>
