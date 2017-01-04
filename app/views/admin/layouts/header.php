
<?php AZ::head(); ?>

<header id="header" class="navbar navbar-fixed-top">
    <nav class="navbar navbar-default" role="navigation">

<!--        <div class="navbar-header primary">
            <a class="navbar-brand" href="<?php _u('admin/dashboard'); ?>">
                <span class="logo-figure"></span>
                <span class="logo-text"><?php __(AZ::setting('administrator')); ?> </span>
            </a>
        </div>-->
        <div class="navbar-toolbar clearfix">

            <ul class="nav navbar-nav navbar-left">
                <li class="dropdown" id="sideMenuIcon">
                    <a id="sideNavigation" class="toggle-nav" title="<?php __('Navigation'); ?>">
                        <i class="fa fa-bars"></i>
                    </a>
                </li>

                <?php AZ::block('header/notify-navigation'); ?>
                <?php AZ::block('header/message-navigation'); ?>

                <li>
                    <a href="<?php echo site_url(); ?>" title="<?php __(AZ::setting('site_name')); ?>" id="siteHome" target="_blank">
                        <i class="fa fa-home"></i>
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
        


