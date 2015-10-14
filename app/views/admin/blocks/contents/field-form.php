
<section id="main">
    <div class="container-fluid">
        <div class="page-header page-header-block">
            <div class="row-fluid">
                <div class="col-xs-7">
                    <h4 class="title">
                        <i class="fa fa-ellipsis-h"></i>
                        <?php echo isset($field->label) ? $field->label : lang('New Field'); ?>
                        <small class="muted">(<?php echo $fieldset_name; ?>)</small>
                    </h4>
                </div>
                <div class="col-xs-5">
                    <div class="btn-group pull-right">
                        <a href="<?php _u('admin/contents/fields/' . $fieldset); ?>" class="btn btn-default btn-sm">
                            <i class="fa fa-arrow-circle-left"></i>
                        </a>
                        <button type="button" class="btn btn-primary  btn-sm click-submit" data-form="#saveContentFieldForm">
                            <i class="fa fa-save"></i>
                        </button>
                    </div>
                    <div class="clearfix"></div>
                </div>

            </div><div class="clearfix"></div>

        </div>
        <?php AZ::block('system-message'); ?>
        <div class="row-fluid">

            <?php echo form_open('admin/contents/save_field', array('id' => 'saveContentFieldForm')); ?>

            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="panel-group" id="accordion">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                        <span class="glyphicon pull-left hidden-xs"></span>
                                        <?php __('Field'); ?>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseOne" class="panel-collapse collapse in">
                                <div class="panel-body">
                                    <div class="field-row row-fluid">
                                        <div class="col-md-4">
                                            <?php
                                            echo form_label(lang('Label'), 'label');
                                            ?>
                                        </div>
                                        <div class="col-md-8">
                                            <?php
                                            echo form_input(array(
                                                'class' => 'form-control',
                                                'id' => 'fieldLabel',
                                                'name' => 'label',
                                                'value' => set_value('label', isset($field->label) ? $field->label : ''),
                                            ));
                                            ?>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="field-row row-fluid">
                                        <div class="col-md-4">
                                            <?php
                                            echo form_label(lang('Name'), 'name');
                                            ?>
                                        </div>
                                        <div class="col-md-8">
                                            <?php
                                            echo form_input(array(
                                                'class' => 'form-control',
                                                'id' => 'fieldName',
                                                'name' => 'name',
                                                'value' => set_value('name', isset($field->name) ? $field->name : ''),
                                            ));
                                            ?>
                                            <small>
                                                <?php __('Use lowercase without space or special character'); ?>
                                            </small>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="field-row row-fluid">
                                        <div class="col-md-4">
                                            <?php
                                            echo form_label(lang('Type'), 'type');
                                            ?>
                                        </div>
                                        <div class="col-md-8">
                                            <?php
                                            $disabled = (isset($field->id) && $field->id > 0) ? ' disabled="disabled" ' : '';
                                            echo form_dropdown('type', field_types(), isset($field->type) ? $field->type : 'text', 'class="form-control" id="contentFieldType" ' . $disabled);
                                            ?>
                                        </div>
                                        <div class="clearfix"></div>

                                    </div>
                                    <div class="field-row row-fluid">
                                        <div class="col-md-4">
                                            <?php
                                            echo form_label(lang('Enabled'), 'enabled');
                                            ?>
                                        </div>
                                        <div class="col-md-8">
                                            <?php
                                            echo form_dropdown('enabled', array('0' => lang('No'), '1' => lang('Yes')), isset($field->enabled) ? $field->enabled : 1, 'class="form-control"');
                                            ?>
                                        </div>
                                        <div class="clearfix"></div>

                                    </div>
                                    <div class="field-row row-fluid">
                                        <div class="col-md-4">
                                            <?php
                                            echo form_label(lang('Required'), 'required');
                                            ?>
                                        </div>
                                        <div class="col-md-8">
                                            <?php
                                            echo form_dropdown('required', array('0' => lang('No'), '1' => lang('Yes')), isset($field->required) ? $field->required : 0, 'class="form-control"');
                                            ?>    
                                        </div>
                                        <div class="clearfix"></div>

                                    </div>

                                    <div class="field-row row-fluid">
                                        <div class="col-md-4">
                                            <?php
                                            echo form_label(lang('in List'), 'in_list');
                                            ?>
                                        </div>
                                        <div class="col-md-8">
                                            <?php
                                            echo form_dropdown('in_list', array('0' => lang('No'), '1' => lang('Yes')), isset($field->in_list) ? $field->in_list : 0, 'class="form-control"');
                                            ?>   
                                        </div>
                                        <div class="clearfix"></div>

                                    </div>

                                    <div class="field-row row-fluid">
                                        <div class="col-md-4">
                                            <?php
                                            echo form_label(lang('in View'), 'in_view');
                                            ?>
                                        </div>
                                        <div class="col-md-8">
                                            <?php
                                            echo form_dropdown('in_view', array('0' => lang('No'), '1' => lang('Yes')), isset($field->in_view) ? $field->in_view : 1, 'class="form-control"');
                                            ?>    
                                        </div>
                                        <div class="clearfix"></div>

                                    </div>
                                    <div class="field-row row-fluid">
                                        <div class="col-md-4">
                                            <?php
                                            echo form_label(lang('in Admin'), 'in_admin_list');
                                            ?>
                                        </div>
                                        <div class="col-md-8">
                                            <?php
                                            echo form_dropdown('in_admin_list', array('0' => lang('No'), '1' => lang('Yes')), isset($field->in_admin_list) ? $field->in_admin_list : 0, 'class="form-control"');
                                            ?>    
                                        </div>
                                        <div class="clearfix"></div>

                                    </div>
                                    <div class="field-row row-fluid">
                                        <div class="col-md-4">
                                            <?php
                                            echo form_label(lang('Access'), 'access[]');
                                            ?>
                                        </div>
                                        <div class="col-md-8">
                                            <?php
                                            echo form_multiselect('access[]', access_A(true), (isset($field->access)) ? explode(',', $field->access) : array(0), 'class="form-control"');
                                            ?>
                                        </div>
                                        <div class="clearfix"></div>

                                    </div>
                                    <div class="field-row row-fluid">
                                        <div class="col-md-4">
                                            <?php
                                            echo form_label(lang('Ordering'), 'ordering');
                                            ?>
                                        </div>
                                        <div class="col-md-8">
                                            <?php
                                            echo form_input(array(
                                                'class' => 'form-control',
                                                'name' => 'ordering',
                                                'value' => isset($field->ordering) ? $field->ordering : '0',
                                            ));
                                            ?>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                                        <span class="glyphicon pull-left hidden-xs"></span>
                                        <?php __('Options'); ?>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseTwo" class="panel-collapse collapse in">
                                <div id="fieldOptionsWrapper" class="panel-body" data-field="<?php echo (isset($field->id)) ? $field->id : NULL; ?>">
                                    <?php echo field_options((isset($field->type)) ? $field->type : 'text', (isset($field->id)) ? $field->id : NULL); ?>
                                </div>
                            </div>
                        </div>

                    </div>


                </div>
                <div class="panel-footer text-right">
                    <?php
                    echo form_hidden('id', $edit_id);
                    echo (isset($fieldset)) ? form_hidden('group_id', $fieldset) : '';
                    ?>

                    <a class="btn btn-default" href="<?php _u('admin/contents/fields/' . $fieldset); ?>">
                        <i class="fa fa-arrow-circle-left"></i>
                        <?php __('Cancel'); ?>
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-save"></i>
                        <?php __('Save'); ?>
                    </button>
                </div>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</section>

<script type="text/javascript">
    (function($){
        $(document).ready(function(){
            $("#fieldLabel").on('keyup',function(){
                var name = $(this).val();
                name = name.toLowerCase();
                name = name.replace(/\s/g,'_');
                $("#fieldName").val(name);
            });
        });
    })(jQuery);
</script>