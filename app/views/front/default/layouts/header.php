
<?php AZ::head(); ?>

<div class="header-container">

    <div class="container-fluid top-container">
        <div class="container">
            <div class="row">
                <div class="col-md-3 brand">
                    <?php _a('/', AZ::setting('site_name') , ' class="logo-brand" ') ?>
                </div>
                <div class="col-xs-6">                    
                    <div role="navigation" class="navbar navbar-default">

                        <button data-target=".navbar-collapse" data-toggle="collapse" class="navbar-toggle" type="button">
                            <span class="sr-only">Toggle</span>
                            
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>

                        <div class="navbar-collapse collapse">
                            <?php echo menu(); ?>
                        </div>
                    </div>

                </div>
                <div class="col-xs-1 pull-right">     
                    <?php AZ::block('account/profile-menu'); ?>
                </div>
                <div class="col-xs-2 pull-right">
                        <ul class="language-switcher navbar-right">
                            <a href="javascript:void(0);" class="dropdown-toggle text-center" data-toggle="dropdown">
                                <i class="fa fa-language"></i>
                                <span class="glyphicon glyphicon-globe"></span>
                                <small class="hidden-xs"><?php __(language_name()); ?></small>
                                <b class="caret"></b></a>
                            <ul class="dropdown-menu dropdown-menu-right ">
                                <?php echo language_flags(); ?>
                            </ul>
                        </ul>
                </div>
                
            </div>
        </div>
    </div>



    <?php AZ::block('header/carousel'); ?>

</div>