<?php
/**
 * My Account page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/my-account.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.6.0
 */

if (!defined('ABSPATH')) exit;

$avatar = get_avatar(get_current_user_id(), 470);


/**
 * My Account navigation.
 * @since 2.6.0
 */

//    do_action('woocommerce_account_navigation');

?>


<div class="container">

    <div class="team_profile account">

        <div class="image">

            <?php echo $avatar; ?>

            <a href='http://en.gravatar.com/' target="_blank" class="btn btn-danger">Change Gravatar</a>

        </div>

        <div class="team_info warning_bg clearfix">

            <div class="account_inner">

                <?php

                /**
                 * My Account content.
                 * @since 2.6.0
                 */

                do_action('woocommerce_account_content');


                ?>

            </div>

        </div>

    </div>

</div>

<?php get_section('account/product_feed') ?>

<?php get_section('account/basket') ?>

