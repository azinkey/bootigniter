
<section id="main">
    <div class="container-fluid">
        <div class="page-header page-header-block">
            <div class="row-fluid">
                <div class="col-md-8">
                    <h4 class="title"><?php __('Notifications');?></h4>
                </div>
                <div class="col-md-4 text-right">

                </div>
            </div>
            <div class="clearfix"></div>
        </div>

        <?php AZ::block('system-message'); ?>

        <div class="row-fluid">
            <div class="col-md-12">

                <?php
                if ($notifications && count($notifications)) {
                    foreach ($notifications as $notification) {
                        ?>
                        <div class="panel">
                            <div class="panel-body">
                                <div class="row-fluid">
                                    <div class="col-xs-11">
                                        <div class="panel dateBox pull-left">
                                            <div class="panel-body text-center">
                                                <strong><?php echo date('d', strtotime($notification->created)); ?></strong>
                                            </div>
                                            <div class="panel-footer text-center">
                                                <small><?php __(date('F', strtotime($notification->created))); ?></small>
                                            </div>
                                        </div>
                                        <h4>
                                            <?php echo $notification->subject; ?></h4>
                                        <?php echo $notification->body; ?>
                                    </div>
                                    <div class="col-xs-1 text-right">
                                        <a class="remove-box" href="<?php _u('admin/dashboard/remove_notification/' . $notification->id); ?>">
                                            <span class="glyphicon glyphicon-trash"></span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    ?>
                    <div class="col-md-12">
                        <?php __('no_record'); ?>
                    </div>
                    <?php
                }
                ?>

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
