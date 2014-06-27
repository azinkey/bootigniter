

<section id="main">
    <div class="container-fluid">
        <div class="page-header page-header-block">
            <div class="row-fluid">
                <div class="col-xs-10">
                    <h4 class="title">
                        <i class="fa fa-ellipsis-h"></i>
                        <?php __('Content Fields'); ?>
                    </h4>
                </div>
                <div class="col-xs-2">
                    <a href="<?php _u('admin/contents/edit_field/-1/' . $q); ?>" class="btn btn-primary btn-sm pull-right" id="fieldModel">
                        <i class="fa fa-plus"></i>
                    </a>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        <?php AZ::block('system-message'); ?>

        <div class="row-fluid">
            <div class="tabbable tabs-left">
                <ul class="nav nav-tabs">
                    <?php
                    foreach ($fieldset_A as $id => $name) {
                        ?>
                        <li class="<?php echo ($id == $q) ? 'active' : '' ?>">
                            <a href="<?php echo _u('admin/contents/fields/' . $id); ?>" title="<?php echo $name; ?>" >
                                <i class="fa fa-folder-open"></i>
                                <span class="hidden-xs"> <?php echo $name; ?></span>
                                <span>
                                    <small>
                                        <?php
                                        if (($id == $q)) {
                                            echo '(' . $total_fields . ')';
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
                    foreach ($fieldset_A as $id => $name) {
                        ?>
                        <div class="tab-pane <?php echo ($id == $q) ? 'active' : '' ?>" id="section-<?php echo $id; ?>">

                            <div class="row-fluid">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <?php echo $name; ?>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="panel-body">
                                        <div class="table">
                                            <?php if (count($fields)) { ?>
                                                <table class="table table-condensed">
                                                    <thead>
                                                        <tr>
                                                            <th><?php __('Label'); ?></th>
                                                            <th class="hidden-xs"><?php __('Type'); ?></th>
                                                            <th class="hidden-xs"><?php __('in List'); ?></th>
                                                            <th class="hidden-xs"><?php __('in View'); ?></th>
                                                            <th class="text-right"><span class="glyphicon glyphicon-edit"></span></th>
                                                        </tr>
                                                    </thead>
                                                    <?php
                                                    foreach ($fields as $field) {
                                                        ?>
                                                        <tr class="<?php echo ($field->system) ? 'active' : ''; ?>">
                                                            <td><?php echo $field->label; ?></td>
                                                            <td class="hidden-xs"><?php echo $field->type; ?></td>
                                                            <td class="hidden-xs">
                                                                <span class="glyphicon <?php echo ($field->in_list) ? 'glyphicon-check' : 'glyphicon-unchecked'; ?>"></span>
                                                            </td>
                                                            <td class="hidden-xs"><span class="glyphicon <?php echo ($field->in_view) ? 'glyphicon-check' : 'glyphicon-unchecked'; ?>"></span></td>
                                                            <td class="small">
                                                                <?php if ((have_permission('contents/edit_field') || have_permission('contents/remove_field')) && !$field->system) : ?>

                                                                    <div class="dropdown pull-right text-left">
                                                                        <a data-toggle="dropdown" class="dropdown-toggle cp">
                                                                            <span class="glyphicon glyphicon-pencil"></span>
                                                                        </a>
                                                                        <ul role="menu" class="dropdown-menu dropdown-menu-right">
                                                                            <?php if (have_permission('contents/edit_field')) : ?>
                                                                                <li>

                                                                                    <a href="<?php _u('admin/contents/edit_field/' . $field->id . '/' . $id); ?>">
                                                                                        <span class="glyphicon glyphicon-edit"></span>
                                                                                        <?php __('Edit'); ?>
                                                                                    </a>
                                                                                </li>
                                                                            <?php endif; ?>
                                                                            <?php if (have_permission('contents/remove_field')) : ?>
                                                                                <li>

                                                                                    <a href="<?php _u('admin/contents/remove_field/' . $field->id . '/' . $id) ?>" class="remove-box">
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
                                                } else {
                                                    echo __('no_record');
                                                }
                                                ?>
                                            </table>
                                        </div>


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
                        <?php
                    }
                    ?>
                </div>
            </div>
            <div class="clearfix"></div>

        </div>



    </div>        

</div>
</section>

