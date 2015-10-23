

<section id="main">
    <div class="container-fluid">
        <div class="page-header page-header-block">
            <div class="row-fluid">
                <div class="col-xs-10">
                    <h4 class="title">
                        <i class="fa fa-user"></i>
                        <?php __('Users'); ?>
                    </h4>
                </div>
                <div class="col-xs-2">

                    <a href="<?php _u('admin/users/edit/-1'); ?>" title="<?php __('Add New User'); ?>" class="btn btn-primary btn-sm pull-right">
                        <i class="fa fa-plus"></i>
                    </a>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        <?php AZ::block('system-message'); ?>
        <div class="row-fluid">
            <div class="tabbable tabs-left">
                <ul class="nav nav-tabs">
                    <?php
                    foreach ($group_A as $id => $name) {
                        ?>
                        <li class="<?php echo ($id == $q) ? 'active' : '' ?>">
                            <a href="<?php echo _u('admin/users/index/' . $id); ?>" title="<?php echo $name; ?>" >
                                <i class="fa fa-users"></i>
                                <span class="hidden-xs"> <?php echo $name; ?></span>
                            </a>
                        </li>
                        <?php
                    }
                    ?>
                </ul>
                <div class="tab-content">
                    <?php foreach ($group_A as $id => $name) { ?>
                        <div class="tab-pane <?php echo ($id == $q) ? 'active' : '' ?>" id="section-<?php echo $id; ?>">
                            <div class="user-grid row-fluid">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <?php echo $name; ?>
                                        <span>
                                            <small>
                                                <?php
                                                if (($id == $q)) : echo '(' . $total_users . ')';
                                                endif;
                                                ?>
                                            </small>
                                        </span>
                                    </div>
                                    <div class="panel-body">
                                        <?php
                                        if (count($users)) {
                                            $i = 0;
                                            foreach ($users as $user) {
                                                $i++;
                                                ?>
                                                <div class="col-md-6">
                                                    <div class="panel user-card">
                                                        <div class="panel-body">
                                                            <div class="col-md-3 stretch text-center hidden-xs hidden-sm">
                                                                <img src="<?php
                                                                echo (!empty($user->avatar)) ? base_url($user->avatar) : base_url('media/users/avatar.png');
                                                                ?>" alt="avatar" class="user-avatar img-polaroid" />
                                                            </div>
                                                            <div class="col-md-7 user-details">
                                                                <h6>
                                                                    <a href="<?php _u('admin/users/edit/' . $user->id) ?>"><?php echo $user->name; ?></a>
                                                                </h6>
                                                                <div class="muted">
                                                                    <i class="fa fa-envelope-o"></i>
                                                                    <?php echo $user->email; ?>
                                                                </div>
                                                                <?php if (!empty($user->country)): ?>
                                                                    <div class="muted">
                                                                        <i class="fa fa-map-marker"></i>
                                                                        <?php echo $user->country; ?>
                                                                    </div>
                                                                <?php endif; ?>
                                                            </div>
                                                            <div class="col-md-2 action-iconset text-right">
                                                                <a href="<?php _u('admin/users/edit/' . $user->id) ?>" class="action-icon">
                                                                    <span class="glyphicon glyphicon-edit"></span>
                                                                </a>
                                                                <a href="<?php _u('admin/users/remove/' . $user->id . '/' . $user->gid) ?>" class="remove-box action-icon">
                                                                    <span class="glyphicon glyphicon-trash"></span>
                                                                </a>
                                                                <div class="clearfix"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php
                                                if ($i % 2 == 0) {
                                                    ?>
                                                    <div class="clearfix"></div>
                                                    <?php
                                                }
                                            }
                                        } else {
                                            ?>
                                            <div class="col-md-12">
                                                <?php __('no_record'); ?>
                                            </div>
                                        <?php } ?>
                                    </div>
                                    <?php if (!empty($pagination)): ?>
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
                    <?php } ?>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</section>


