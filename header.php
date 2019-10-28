<?php

//$class = is_user_logged_in() ? 'logged_in' : 'logged_out';


?>
<!doctype html>
<!--[if IE 7]><html class="ie ie7 " <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]><html class="ie ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html class="ie no-js" <?php language_attributes(); ?>> <!--<![endif]-->

    <head>
        <meta charset="<?php bloginfo('charset'); ?>">
        <title><?php   wp_title('|', true, 'right'); ?></title>

        <!-- Mobile viewport optimize -->
        <meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, minimum-scale=1, user-scalable=no">

        <?php wp_head(); ?>
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->


        <?php echo get_field('header_scripts','option'); ?>

        <script src='https://www.google.com/recaptcha/api.js'></script>

        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-111485778-1"></script>
        <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        
        gtag('config', 'UA-111485778-1');
        </script>

    </head>

    <body <?php body_class($class); ?>>

    <?php echo get_field('body_scripts','option'); ?>

        <div class="wrapper">

            <?php require_once WP_HELPER::CONTENT_ABS_URL() . '/header/header_init.php'; ?>