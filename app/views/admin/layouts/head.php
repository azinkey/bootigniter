<!DOCTYPE html>
<html lang="<?php echo language_code() ?>">

    <head>

        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <meta name="site_url" content="<?php _u(''); ?>">


        <link rel="stylesheet"  href="<?= skin_url(); ?>css/bootstrap.css"  />
        <link rel="stylesheet"  href="<?= skin_url(); ?>css/bootstrap-theme.css"  />
        <link rel="stylesheet"  href="<?= skin_url(); ?>css/font-awesome.min.css"  />
        <link rel="stylesheet"  href="<?= skin_url(); ?>css/style.css"  />
        
        <?php
        if (isset($styles)) {
            load_styles($styles);
        }
        ?>

        <script src="<?= skin_url(); ?>scripts/jquery-1.11.0.min.js" type="text/javascript"></script>
        <script src="<?= skin_url(); ?>scripts/bootstrap.js" type="text/javascript"></script>
        <?php
        
        if (isset($scripts)) {
            echo load_scripts($scripts);
        }
        ?>

        <title> <?php echo page_title(); ?> </title>



    </head>

    <body class="<?php echo page_class(); ?>">

