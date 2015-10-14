

<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title" id="myModalLabel"><?php __('Add New Label'); ?></h4>
</div>
<div class="modal-body">
    <?php echo form_open('admin/dashboard/save_label', 'class="form-inline label-form" role="form"'); ?>    
    <div class="row">
        <div class="col-xs-3">
            <div class="input-group">
                <?php
                echo form_input(array(
                    'class' => 'form-control  color-picker-input',
                    'name' => 'color',
                    'placeholder' => '#333333',
                    'value' => isset($label->color) ? $label->color : '',
                ));
                ?>
            </div>
        </div>
        <div class="col-xs-8">

            <div class="input-group">
                <?php
                echo form_input(array(
                    'class' => 'form-control',
                    'name' => 'label',
                    'placeholder' => 'Name',
                    'value' => isset($label->label) ? $label->label : '',
                ));
                ?>

                <span class="input-group-btn">
                    <?php echo form_hidden('mode', $mode); ?>
                    <?php echo form_hidden('user_id', user::id() ); ?>
                    <?php echo (isset($label->id)) ? form_hidden('id', $label->id) : ''; ?>
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-save"></i>
                        <?php __('Save'); ?>
                    </button>
                </span>
            </div>

        </div>
    </div>


    <?php echo form_close(); ?>
</div>


<script>
    (function($) {
        $(document).ready(function() {
            $(".color-picker-input").colorpicker();
        });
    })(jQuery);
</script>