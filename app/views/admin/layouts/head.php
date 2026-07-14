<!DOCTYPE html>
<html lang="<?php echo language_code() ?>">

    <head>

        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="site_url" content="<?php _u(''); ?>">
		
		<link rel="shortcut icon" href="<?= skin_url(); ?>images/favicon.ico" type="image/x-icon">
		<link rel="icon" href="<?= skin_url(); ?>images/favicon.ico" type="image/x-icon">
		<link rel="apple-touch-icon-precomposed" href="<?= skin_url(); ?>images/apple-touch-icon.png" sizes="144x79">

        <!-- Bootstrap 5.3.8 -->
        <link rel="stylesheet" href="<?= skin_url(); ?>css/bootstrap.min.css" />
        <!-- Font Awesome 6 Free -->
        <link rel="stylesheet" href="<?= skin_url(); ?>css/font-awesome.min.css" />
        <!-- BootIgniter Admin Skin -->
        <link rel="stylesheet" href="<?= skin_url(); ?>css/style.css" />
        <link rel="stylesheet" href="<?= skin_url(); ?>css/theme.css" />
        
        <?php
        if (isset($styles)) {
            load_styles($styles);
        }
        ?>

        <!-- jQuery 3.7.1 -->
        <script src="<?= skin_url(); ?>scripts/jquery-3.7.1.min.js"></script>
        <!-- Bootstrap 5.3.8 Bundle (includes Popper) -->
        <script src="<?= skin_url(); ?>scripts/bootstrap.bundle.min.js"></script>
        <?php
        if (isset($scripts)) {
            echo load_scripts($scripts);
        }
        ?>

        <title> <?php echo page_title(); ?> </title>



    </head>

    <body class="<?php echo page_class(); ?>">

