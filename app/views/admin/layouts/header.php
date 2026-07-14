
<?php AZ::head(); ?>

<header id="header" class="navbar navbar-fixed-top">
    <nav class="navbar navbar-expand navbar-dark" role="navigation">

        <div class="navbar-toolbar clearfix">

            <ul class="nav navbar-nav me-auto">
                <li class="nav-item dropdown" id="sideMenuIcon">
                    <a id="sideNavigation" class="nav-link toggle-nav" title="<?php __('Navigation'); ?>">
                        <i class="fa-solid fa-bars"></i>
                    </a>
                </li>

                <?php AZ::block('header/notify-navigation'); ?>
                <?php AZ::block('header/message-navigation'); ?>

                <li class="nav-item">
                    <a class="nav-link" href="<?php echo site_url(); ?>" title="<?php __(AZ::setting('site_name')); ?>" id="siteHome" target="_blank">
                        <i class="fa-solid fa-house"></i>
                    </a>
                </li>

            </ul>

            <?php AZ::block('header/user-navigation'); ?>

        </div>
    </nav>
</header>


<div id="wrapper">
    <div id="canvas">
        <?php  AZ::block('navigations'); ?>
        


