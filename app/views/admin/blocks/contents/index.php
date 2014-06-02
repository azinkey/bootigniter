

<section id="main">
    <div class="container-fluid">
        <div class="page-header page-header-block">
            <div class="row-fluid">
                <div class="col-xs-10">
                    <h4 class="title">
                        <i class="fa fa-pencil-square"></i>
                        <?php __($contentType->name); ?>
                    </h4>
                </div>
                <div class="col-xs-2">
                    <a href="<?php _u('admin/contents/edit/' . $contentType->alias . '/' . '-1'); ?>" title="<?php __('Add New') ?>" class="btn btn-primary btn-sm pull-right">
                        <i class="fa fa-plus"></i>
                    </a>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        <?php AZ::block('system-message'); ?>

        <div class="row-fluid">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <small class="muted"><?php __($contentType->description); ?></small>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-body">
                    <?php
                    if ($contents && count($contents)) {
                        ?>
                        <div class="table">
                            <table class="table table-condensed">
                                <thead>
                                    <tr>
                                        <th  width="5%" class="hidden-xs" >
                                            <?php __('ID'); ?>
                                        </th>
                                        <th  width="10%" class="hidden-xs"><?php __('Alias'); ?></th>

                                        <?php
                                        if ($admin_list_fields && count($admin_list_fields)) {
                                            foreach ($admin_list_fields as $key => $label) {
                                                ?>
                                                <th><?php echo $label; ?></th>
                                                <?php
                                            }
                                        }
                                        ?>
                                        <?php if ($contentType->have_groups) : ?>
                                            <th  width="10%" ><?php __('Group'); ?></th>
                                        <?php endif; ?>
                                        <th  width="5%" class="text-center"><?php __('Status'); ?></th>
                                        <th  width="18%"  class="text-right hidden-xs hidden-sm"><?php __('Last Modified'); ?></th>
                                        <th  width="22%"  class="text-right hidden-xs hidden-sm"><?php __('Created'); ?></th>
                                        <th width="10%" class="text-right"><span class="glyphicon glyphicon-edit"></span></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($contents as $content) {
                                        ?>
                                        <tr>
                                            <td class="hidden-xs"><?php echo $content->id; ?></td>
                                            <td class="hidden-xs">
                                                <?php echo (isset($content->alias)) ? $content->alias : ''; ?>
                                            </td>

                                            <?php
                                            if ($admin_list_fields && count($admin_list_fields)) {
                                                foreach ($admin_list_fields as $key => $label) {
                                                    ?>
                                                    <td><?php echo (isset($content->{$key})) ? $content->{$key} : '';  ?></td>
                                                    <?php
                                                }
                                            }
                                            ?>
                                            <?php if ($contentType->have_groups) : ?>
                                                <td><?php echo $content->groups; ?></td>
                                            <?php endif; ?>
                                            <td class="text-center">
                                                <span class="glyphicon <?php echo ($content->status) ? 'glyphicon-check' : 'glyphicon-unchecked'; ?>"></span>
                                            </td>
                                            <td class="text-right hidden-xs hidden-sm"><?php echo date_when(human_to_unix($content->modified)); ?></td>
                                            <td class="text-right hidden-xs hidden-sm"><?php echo $content->timestamp; ?></td>
                                            <td class="small">
                                                <a href="<?php _u('admin/contents/remove/' . $contentType->alias . '/' . $content->id) ?>" class=" action-icon remove-box pull-right">
                                                    <span class="glyphicon glyphicon-trash"></span>
                                                </a>
                                                <a href="<?php _u('admin/contents/edit/' . $contentType->alias . '/' . $content->id) ?>" class="action-icon pull-right">
                                                    <span class="glyphicon glyphicon-edit"></span>
                                                </a>

                                            </td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <?php
                    } else {
                        __('no_record');
                    }
                    ?>
                </div>
                <?php
                if (!empty($pagination)):
                    ?>
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
</section>


