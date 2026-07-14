

<section id="main">
    <div class="container-fluid">
        <div class="page-header page-header-block">
            <div class="row-fluid">
                <div class="col-10">
                    <h4 class="title">
                        <i class="fa-solid fa-user"></i>
                        <?php __('Users'); ?>
                    </h4>
                </div>
                <div class="col-2">

                    <a href="<?php _u('admin/users/edit/-1'); ?>" title="<?php __('Add New User'); ?>" class="btn btn-primary btn-sm float-end">
                        <i class="fa-solid fa-plus"></i>
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
                                <i class="fa-solid fa-users"></i>
                                <span class="d-none d-sm-block"> <?php echo $name; ?></span>
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
                                <div class="card panel-default">
                                    <div class="card-header">
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
                                    <div class="card-body">
                                        <?php
                                        if (count($users)) {
                                            $i = 0;
                                            foreach ($users as $user) {
                                                $i++;
                                                ?>
                                                <div class="col-md-6">
                                                    <div class="card user-card">
                                                        <div class="card-body">
                                                            <div class="col-md-3 stretch text-center d-none d-sm-block d-sm-none d-md-block">
                                                                <img src="<?php
                                                                echo (!empty($user->avatar)) ? base_url($user->avatar) : base_url('media/users/avatar.png');
                                                                ?>" alt="avatar" class="user-avatar img-polaroid" />
                                                            </div>
                                                            <div class="col-md-7 user-details">
                                                                <h6>
                                                                    <a href="<?php _u('admin/users/edit/' . $user->id) ?>"><?php echo $user->name; ?></a>
                                                                </h6>
                                                                <div class="muted">
                                                                    <i class="fa-solid fa-envelope-o"></i>
                                                                    <?php echo $user->email; ?>
                                                                </div>
                                                                <?php if (!empty($user->country)): ?>
                                                                    <div class="muted">
                                                                        <i class="fa-solid fa-map-marker"></i>
                                                                        <?php echo $user->country; ?>
                                                                    </div>
                                                                <?php endif; ?>
                                                            </div>
                                                            <div class="col-md-2 action-iconset text-right">
                                                                <a href="<?php _u('admin/users/edit/' . $user->id) ?>" class="action-icon">
                                                                    <span class="fa-solid fa-edit"></span>
                                                                </a>
                                                                <a href="<?php _u('admin/users/remove/' . $user->id . '/' . $user->gid) ?>" class="remove-box action-icon">
                                                                    <span class="fa-solid fa-trash"></span>
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
                                        <div class="card-footer">
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


