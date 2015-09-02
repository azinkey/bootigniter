

<section id="main">
    <div class="container-fluid">
        <div class="page-header page-header-block">
            <div class="row-fluid">
                <div class="col-xs-7">
                    <h4 class="title">
                        <i class="fa fa-file-o"></i>
                        <?php echo (isset($content_id) && $content_id > 0) ? __('Edit', true) . __(rtrim($contentType->name, 's'), true) . ': ' . $content_id : __('New', true) . __(rtrim($contentType->name, 's'), true); ?>
                    </h4>
                </div>
                <div class="col-xs-5">
                    <div class="btn-group pull-right">
                        <a title="<?php __("Back to List"); ?>" href="<?php _u('admin/contents/index/' . $contentType->alias); ?>" class="btn btn-default btn-sm">
                            <i class="fa fa-arrow-circle-left"></i>
                        </a>
                        <button title="<?php __("Save & New"); ?>"  type="button" class="btn btn-primary btn-sm click-submit" data-form="#saveContentForm" data-return="<?php _u('admin/contents/edit/' . $contentType->alias . '/-1'); ?>">
                            <i class="glyphicon glyphicon-saved"></i>
                        </button>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        <?php AZ::block('system-message'); ?>
        <div class="row-fluid">

            <div class="tabbable">
                <ul class="nav nav-tabs">
                    <?php
                    if ($languages && count($languages)) {
                        $i = 0;
                        foreach ($languages as $language) {
                            $class = ($language->is_admin) ? 'active' : '';
                            ?>   
                            <li class="<?php echo $class; ?>">
                                <a href="#section-<?php echo $language->id; ?>" data-toggle="tab">
                                    <span class="glyphicon glyphicon-globe"></span>
                                    <span><?php echo $language->name; ?></span>
                                </a>
                            </li>
                            <?php
                            $i++;
                        }
                    }
                    ?>
                </ul>
                <div class="tab-content">

                    <?php
                    if ($languages && count($languages)) {
                        $i = 0;
                        foreach ($languages as $language) {
                            $class = ($language->is_default) ? 'active' : '';
                            ?>   
                            <div class="tab-pane <?php echo $class; ?>" id="section-<?php echo $language->id; ?>">
                                <?php echo form_open_multipart('admin/contents/save', array('id' => 'saveContentForm')); ?>
                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        <div class="row-fluid">
                                            <div class="col-md-8 p0">
                                                <div class="panel-group" id="accordion">
                                                    <?php
                                                    if ($fieldsets && count($fieldsets)) {
                                                        foreach ($fieldsets as $fieldset) {
                                                            ?>    
                                                            <div class="panel panel-default">
                                                                <div class="panel-heading">
                                                                    <h4 class="panel-title">
                                                                        <a data-toggle="collapse" data-parent="#accordion" href="#fieldset-<?php echo $fieldset->id; ?>">
                                                                            <span class="glyphicon pull-left hidden-xs"></span>
                                                                            <?php __($fieldset->name); ?>
                                                                        </a>
                                                                    </h4>
                                                                </div>
                                                                <div id="fieldset-<?php echo $fieldset->id; ?>" class="panel-collapse collapse in">
                                                                    <div class="panel-body">
                                                                        <?php
                                                                        $fields = fields_from_fieldset($fieldset->id);
                                                                        foreach ($fields as $field) {
                                                                            ?>

                                                                            <div class="field-row row-fluid">
                                                                                <div class="col-md-4">
                                                                                    <?php
                                                                                    echo form_label(__($field->label, true), $field->name);
                                                                                    echo ($field->required) ? '<span class="red"> *</span>' : '';
                                                                                    ?>
                                                                                </div>
                                                                                <div class="col-md-8">
                                                                                    <?php
                                                                                    echo field_render($field, $content_id, $language->id);
                                                                                    ?>
                                                                                </div>
                                                                                <div class="clearfix"></div>
                                                                            </div>

                                                                            <?php
                                                                        }
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="col-md-4 pr0">
                                                <div class="panel-group" id="publish-content">
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading">
                                                            <h4 class="panel-title">
                                                                <a data-toggle="collapse" data-parent="#publish-content" href="#fieldset_publish">
                                                                    <span class="glyphicon pull-left hidden-xs"></span>
                                                                    <?php __('Publish'); ?>
                                                                </a>
                                                            </h4>
                                                        </div>
                                                        <div id="fieldset_publish" class="panel-collapse collapse in">
                                                            <br />
                                                            <div class="row-fluid">
                                                                <div class="col-md-12">
                                                                    <div class="field-row form-light">
                                                                        <div class="col-xs-12">
                                                                            <span class="glyphicon glyphicon-link"></span>
                                                                            <?php
                                                                            echo form_label(AZ::setting('site_url'), 'alias');
                                                                            echo form_input(array(
                                                                                'name' => 'alias',
                                                                                'placeholder' => isset($contentType->name) ? rtrim($contentType->name, 's') . '-ID' : '',
                                                                                'value' => isset($content->alias) ? $content->alias : '',
                                                                            ));
                                                                            ?>

                                                                        </div>
                                                                        <div class="clearfix"></div>
                                                                    </div>

                                                                    <div class="field-row">
                                                                        <div class="col-xs-5">
                                                                            <i class="fa fa-check-square-o"></i>
                                                                            <?php echo form_label(lang('Status'), 'status'); ?>
                                                                        </div>
                                                                        <div class="col-xs-7">
                                                                            <?php
                                                                            echo form_dropdown('status', array('0' => lang('No'), '1' => lang('Yes')), isset($content->status) ? $content->status : 1, 'class="form-control input-sm"');
                                                                            ?>    
                                                                        </div>
                                                                        <div class="clearfix"></div>
                                                                    </div>
                                                                    <div class="field-row">
                                                                        <div class="col-xs-5">
                                                                            <i class="fa fa-eye"></i>
                                                                            <?php echo form_label(lang('Access'), 'access[]'); ?>
                                                                        </div>
                                                                        <div class="col-xs-7">
                                                                            <?php
                                                                            echo form_multiselect('access[]', access_A(true), (isset($content->access)) ? explode(',', $content->access) : array(0), 'class="form-control"');
                                                                            ?>    
                                                                        </div>
                                                                        <div class="clearfix"></div>
                                                                    </div>
                                                                </div>
                                                                <div class="clearfix"></div>
                                                            </div>
                                                            <div class="clearfix"></div>
                                                            <br />
                                                        </div>
                                                    </div>
                                                    <?php if ($contentType->have_groups): ?>
                                                        <div class="panel panel-default">
                                                            <div class="panel-heading">
                                                                <h4 class="panel-title">
                                                                    <a data-toggle="collapse" data-parent="#publish-content" href="#fieldset_publish">
                                                                        <span class="glyphicon pull-left hidden-xs"></span>
                                                                        <?php __('Groups Categories'); ?>
                                                                    </a>

                                                                </h4>
                                                            </div>
                                                            <div id="fieldset_publish" class="panel-collapse collapse in">
                                                                <br />
                                                                <div class="row-fluid">
                                                                    <div class="col-md-12">
                                                                        <div class="field-row">
                                                                            <div class="col-xs-5">
                                                                                <i class="fa fa-folder-open-o"></i>
                                                                                <?php echo form_label(lang('Group'), 'group_id'); ?>
                                                                            </div>
                                                                            <div class="col-xs-7">
                                                                                <?php
                                                                                echo form_dropdown('group_id', $groups, isset($content->group_id) ? $content->group_id : 0, 'class="form-control input-sm"');
                                                                                ?>    
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="clearfix"></div>
                                                                </div>
                                                                <div class="clearfix"></div>
                                                                <br />
                                                            </div>
                                                        </div>
        <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel-footer">
                                        <div class="col-md-12 text-right">
        <?php echo form_hidden('id', $content_id); ?>
                                            <?php echo form_hidden('language_id', $language->id); ?>
                                            <?php echo (isset($contentType->id)) ? form_hidden('type_id', $contentType->id) : ''; ?>
                                            <?php echo (isset($contentType->alias)) ? form_hidden('type', $contentType->alias) : ''; ?>

                                            <a href="<?php _u('admin/contents/index/' . $contentType->alias); ?>" class="btn btn-default">
                                                <i class="fa fa-arrow-circle-left"></i>
        <?php __('Cancel'); ?>
                                            </a>
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fa fa-save"></i>
        <?php __('Save'); ?>
                                            </button>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
        <?php echo form_close(); ?>
                            </div>
                                <?php
                                $i++;
                            }
                        }
                        ?>
                </div>
            </div>
            <div class="clearfix"></div>
            <br />
        </div>
    </div>
</section>

