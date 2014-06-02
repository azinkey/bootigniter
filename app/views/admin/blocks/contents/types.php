

<section id="main">
    <div class="container-fluid">
        <div class="page-header page-header-block">
            <div class="row-fluid">
                <div class="col-xs-10">
                    <h4 class="title">
                        <i class="fa fa-sliders"></i>
                        <?php __('Content Types'); ?>
                    </h4>
                </div>
                <div class="col-xs-2">
                    <a href="<?php _u('admin/contents/edit_type/-1'); ?>" class="btn btn-primary btn-sm pull-right edit-box" id="createContentType" data-target="#contentTypeFormModel">
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
                    <?php __('Content Types'); ?>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-body">
                    <div class="table">
                        <table class="table table-condensed">
                            <thead>
                                <tr>
                                    <th  class="hidden-xs" ><?php __('ID'); ?></th>
                                    <th><?php __('Name'); ?></th>
                                    <th><?php __('Description'); ?></th>
                                    <th><?php __('Active'); ?></th>
                                    <th class="text-right">
                                        <span class="glyphicon glyphicon-edit"></span>
                                    </th>
                                </tr>
                            </thead>
                            <?php
                            if (count($types)) {
                                foreach ($types as $type) {
                                    ?>
                                    <tr class="<?php echo ($type->system) ? 'active' : ''; ?>">
                                        <td class="hidden-xs"><?php echo $type->id; ?></td>
                                        <td><?php __($type->name); ?></td>
                                        <td><?php __($type->description); ?></td>
                                        <td>
                                            <span class="glyphicon <?php echo ($type->enabled) ? 'glyphicon-check' : 'glyphicon-unchecked'; ?>"></span>
                                        </td>
                                        <td class="small">
                                            <?php if (!$type->system): ?>                                                    

                                                <a href="<?php _u('admin/contents/remove_type/' . $type->id) ?>" class="remove-box action-icon pull-right">
                                                    <span class="glyphicon glyphicon-trash"></span>
                                                </a>
                                                <a href="<?php _u('admin/contents/edit_type/' . $type->id) ?>" data-target="#contentTypeFormModel" class="edit-box action-icon pull-right">
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

                <?php
                if ($pagination) {
                    ?>
                    <div class="panel-footer">
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
