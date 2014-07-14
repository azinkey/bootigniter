
<section id="main">
    <div class="container-fluid">
        <div class="page-header page-header-block">
            <div class="row-fluid">
                <div class="col-md-8">
                    <h4 class="title"><?php __('Messages'); ?></h4>
                </div>
                <div class="col-md-4 text-right">

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
                            <div class="col-md-2">
                                <a href="<?php _u('admin/dashboard/write_message'); ?>" class="btn btn-danger btn-block">
                                    <span class="glyphicon glyphicon-edit"></span>
                                    <?php __('Compose Mail'); ?>
                                </a>
                                <hr />
                                <h5> <span class="glyphicon glyphicon-folder-open"></span> Folders</h5>
                                <ul class="inbox-options list-group list-unstyled">
                                    <li class="list-group-item">
                                        <a href="<?php _u('admin/dashboard/messages/inbox') ?>">
                                            <span class="glyphicon glyphicon-envelope"></span>
                                            <?php __('Inbox'); ?>
                                            <?php
                                            if ($count_unread_message) {
                                                ?>
                                                <span class="badge pull-right"><?php echo $count_unread_message; ?></span>
                                                <?php
                                            }
                                            ?>

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
                                <h5> 
                                    <span class="glyphicon glyphicon-tags"></span> <?php __('Labels')?>
                                    <a href="javascript:void(0)" class="pull-right" id="createLabel" data-toggle="modal" data-target="#labelFormModel">
                                        <span class="glyphicon glyphicon-plus"></span>
                                    </a>
                                </h5>
                                <ul class="labels-list list-group list-unstyled">
                                    <?php
                                    if ($labels && count($labels)) {
                                        foreach ($labels as $label) {
                                            ?>
                                            <li class="list-group-item">

                                                <a href="<?php _u('admin/dashboard/label_messages/' . $label->id); ?>">
                                                    <span class="glyphicon glyphicon-tag" style="color: <?php echo $label->color; ?>"></span>
                                                    <?php echo $label->label; ?>
                                                </a>


                                                <a href="<?php _u('admin/dashboard/remove_label/' . $label->id) ?>" data-target="#modal" class="remove-box pull-right hide remove-label">
                                                    <small class="muted"><span class="glyphicon glyphicon-trash"></span></small>
                                                </a>

                                                <div class="clearfix"></div>
                                            </li>
                                            <?php
                                        }
                                    }
                                    ?>
                                </ul>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group">
                                    <div class="has-icon">
                                        <input type="text" placeholder="<?php __('Filter message...');?>" class="form-control">

                                    </div>
                                    <div class="input-group-btn">
                                        <button class="btn btn-default" type="button">
                                            <span class="glyphicon glyphicon-search"></span>
                                            <?php __('Search'); ?>
                                        </button>
                                    </div>
                                </div>
                                <hr class="" />
                                <div class="media-list message-list">
                                    <?php
                                    
                                    if ($messages && count($messages)) {
                                        
                                        foreach ($messages as $message) {
                                            ?>
                                            <div class="media">
                                                <span class="pull-left">
                                                    <img width="44" height="44" alt="avatar" class="media-object img-circle" src="<?php echo user::avatar($message->author); ?>">
                                                </span>
                                                <span class="media-body">

                                                    <a href="<?php _u('admin/dashboard/label_messages/' . $label_id . '/' . $message->id); ?>">
                                                        <strong class="media-heading">
                                                            <?php echo $message->subject; ?>
                                                        </strong>
                                                    </a>
                                                    <?php if ($message->have_attachment): ?>
                                                        <span class="media-meta  pull-right">
                                                            <i class="glyphicon glyphicon-paperclip"></i>
                                                        </span>
                                                    <?php endif; ?>
                                                    <?php if ($message->is_star): ?>
                                                        <span class="media-meta pull-right">
                                                            <i class="glyphicon glyphicon-star"></i>
                                                        </span>
                                                    <?php endif; ?>
                                                    <span class="media-text">
                                                        <?php echo word_limiter($message->body, 11); ?>
                                                    </span>

                                                    <!-- meta icon -->

                                                    <span class="media-meta pull-right">
                                                        <?php echo date_when(human_to_unix($message->created)); ?>
                                                    </span>
                                                    <!--/ meta icon -->
                                                </span>
                                            </div>
                                            <br />
                                            <?php
                                        }
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
                                    <br />
                                <?php endif; ?>
                            </div>
                            <?php if(isset($selected_message->id)): ?>
                            <div class="col-md-6 text-right">

                                <div class="btn-group">

                                    <a class="btn btn-default" href="<?php _u('admin/dashboard/message_star_flag/' . $selected_message->id . '/' . $selected_message->is_star); ?>" title="<?php echo ($selected_message->is_star) ? lang('Remove Star Mark') : lang('Mark as Star'); ?>">
                                        <i class="glyphicon <?php echo ($selected_message->is_star) ? 'glyphicon-star' : 'glyphicon-star-empty'; ?>"></i>
                                    </a>
                                    <a class="btn btn-default" title="<?php __('Forward'); ?>" href="<?php _u('admin/dashboard/forward_message/' . $selected_message->id); ?>">
                                        <i class="glyphicon glyphicon-share-alt"></i>
                                    </a>
                                    <a class="btn btn-default" title="<?php __('Reply'); ?>" href="<?php _u('admin/dashboard/write_message/' . $selected_message->id); ?>">
                                        <i class="glyphicon glyphicon-retweet"></i>
                                    </a>

                                    <a class="btn btn-default" title="<?php __('Add Label'); ?>">
                                        <i class="glyphicon glyphicon-tags"></i>
                                    </a>
                                    <a class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                        <span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu text-left" role="menu">
                                        <li><a><?php __('Choose Label'); ?></a></li>
                                        <li class="divider"></li>
                                        <?php
                                        if ($labels && count($labels)) {
                                            foreach ($labels as $label) {
                                                ?>
                                                <li>
                                                    <a href="<?php _u('admin/dashboard/message_label/' . $selected_message->id . '/' . $label->id); ?>">
                                                        <span class="glyphicon glyphicon-tag" style="color: <?php echo $label->color; ?>"></span>
                                                        <?php echo $label->label; ?>
                                                    </a>
                                                </li>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </ul>
                                </div>
                                <div class="btn-group">
                                    <a class="btn btn-default remove-box" href="<?php _u('admin/dashboard/trash_message/' . $selected_message->id); ?>">
                                        <i class="glyphicon glyphicon-trash"></i>
                                    </a>
                                </div>

                                <hr />


                                <ul class="list-table">
                                    <li style="width:70px;">
                                        <img width="65px" height="65px" alt="" src="<?php echo user::avatar($selected_message->author) ?>" class="img-circle">
                                    </li>
                                    <li class="text-left">
                                        <h4 class="semibold ellipsis nm">
                                            <?php echo $selected_message->name; ?> <br />
                                            <small class="text-muted">
                                                <?php echo $selected_message->email; ?>
                                                <?php __('to'); ?><strong><?php __('Me'); ?></strong>
                                            </small>
                                        </h4>
                                    </li>
                                    <li class="text-right">
                                        <?php if (!empty($selected_message->label_name)) : ?>
                                            <span class="glyphicon glyphicon-tag" style="color: <?php echo $selected_message->color; ?>"></span>
                                            <?php echo $selected_message->label_name; ?>
                                        <?php endif; ?>
                                        <h5 class="semibold text-muted"><?php echo date_when(human_to_unix($selected_message->created)) ?></h5>
                                    </li>
                                </ul>
                                <br />
                                <a>
                                    <h4 class="text-left">
                                        <?php echo $selected_message->subject; ?>
                                    </h4>
                                </a>
                                <br />
                                <div class="panel-body text-left">
                                    <?php echo $selected_message->body; ?>
                                </div>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>



            </div>
        </div>


    </div>
</section>

<div class="modal fade" id="labelFormModel" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <?php echo form_open('admin/dashboard/save_label'); ?>
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel"><?php __('Add New Label'); ?></h4>
            </div>
            <div class="modal-body">
                <div class="field-row">
                    <label for="key"><?php __('Label Name'); ?></label>
                    <input type="text" class="form-control" name="label" />
                </div>
                <div class="field-row">
                    <label for="key"><?php __('Color'); ?></label>
                    <input type="text" class="form-control"  name="color" value="#333" />        
                </div>
            </div>
            <div class="modal-footer">
                <?php echo form_hidden('mode', 'inbox'); ?>
                <?php echo form_hidden('user_id', user::id()); ?>
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php __('Cancel'); ?></button>
                <button type="submit" class="btn btn-primary">
                    <span class="glyphicon glyphicon-ok"></span>
                    <?php __('Save'); ?>
                </button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>
