
<?php AZ::head(); ?>

<div class="header-container">

    <div class="container-fluid top-container">
        <div class="container">
            <nav class="navbar navbar-expand-md navbar-light bg-white">
                
                <!-- Brand -->
                <div class="navbar-brand">
                    <?php _a('', AZ::setting('site_name'), 'class="logo-brand"') ?>
                </div>

                <!-- Mobile toggler -->
                <button class="navbar-toggler" type="button"
                    data-bs-toggle="collapse" data-bs-target="#mainNavbar"
                    aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Nav items -->
                <div class="collapse navbar-collapse" id="mainNavbar">
                    <?php echo menu(); ?>
                </div>

                <!-- Language switcher -->
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="fa-solid fa-globe"></i>
                            <small class="d-none d-sm-inline"><?php __(language_name()); ?></small>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <?php echo language_flags(); ?>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <?php AZ::block('account/profile-menu'); ?>
                    </li>
                </ul>

            </nav>
        </div>
    </div>

    <?php AZ::block('header/carousel'); ?>

</div>