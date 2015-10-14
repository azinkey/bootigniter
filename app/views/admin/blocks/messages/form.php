
<section id="main">
    <div class="container-fluid">
        <div class="page-header page-header-block">
            <div class="row-fluid">
                <div class="col-xs-12">
                    <h4 class="title"><?php __('Compose Mail'); ?></h4>
                </div>

            </div>
            <div class="clearfix"></div>
        </div>

        <?php AZ::block('system-message'); ?>

        <div class="row-fluid">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="row-fluid">
                            <div class="col-md-3">

                                <h5> <span class="glyphicon glyphicon-folder-open"></span> Folders</h5>
                                <ul class="inbox-options list-group list-unstyled">
                                    <li class="list-group-item">
                                        <a href="<?php _u('admin/dashboard/messages/inbox') ?>">
                                            <span class="glyphicon glyphicon-envelope"></span>
                                            <?php __('Inbox'); ?>
                                        </a>
                                    </li>
                                    <li class="list-group-item">
                                        <a href="<?php _u('admin/dashboard/messages/stared') ?>">
                                            <span class="glyphicon glyphicon-star"></span>
                                            <?php __('Stared'); ?>
                                        </a>
                                    </li>
                                    <li class="list-group-item">
                                        <a href="<?php _u('admin/dashboard/messages/outbox') ?>">
                                            <span class="glyphicon glyphicon-send"></span>
                                            <?php __('Outbox'); ?>
                                        </a>
                                    </li>
                                    <li class="list-group-item">
                                        <a href="<?php _u('admin/dashboard/messages/trash') ?>">
                                            <span class="glyphicon glyphicon-trash"></span>
                                            <?php __('Trash'); ?>
                                        </a>
                                    </li>
                                </ul>

                            </div>

                            <div class="col-md-9">
                                <?php echo form_open('admin/dashboard/send_message'); ?>
                                <div class="field-row">
                                    <?php
                                    echo form_label(lang('Users'), 'users[]');
                                    echo form_multiselect('users[]', $user_options, $to_user, ' class="chosen" data-placeholder="To Users.."');
                                    ?>
                                </div>
                                <div class="field-row">
                                    <?php
                                    echo form_label(lang('Subject'), 'subject');
                                    echo form_input(array(
                                        'class' => 'form-control',
                                        'name' => 'subject',
                                    ));
                                    ?>
                                </div>
                                <div class="field-row">
                                    <?php
                                    echo form_label(lang('Message'), 'body');
                                    echo form_textarea(array(
                                        'class' => 'form-control',
                                        'name' => 'body',
                                    ));
                                    ?>    
                                </div>
                                <div class="panel-footer text-right">
                                    <input type="hidden" name="author" value="<?php echo user::id(); ?>" />
                                    <input type="hidden" name="message_id" value="<?php echo $message_id; ?>" />
                                    <a class="btn btn-default" href="<?php _u('admin/dashboard/messages'); ?>">
                                        <i class="fa fa-arrow-circle-left"></i>
                                        <?php __('Cancel'); ?>
                                    </a>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-send"></i>
                                        <?php __('Send'); ?>
                                    </button>
                                    <?php echo form_close(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>



<script type="text/javascript">
    (function($) {
        $(document).ready(function() {
            $(".chosen").chosen();
        });
    })(jQuery);
</script>