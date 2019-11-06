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


        <div class="customer_profile">       

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



<Script>
    //table table-striped
    const tableNew1 = document.querySelector('.woocommerce-table--order-details');

    tableNew1.classList.remove('shop_table');

    tableNew1.classList.add('table', 'table-striped');
    tableNew1.classList.remove('woocommerce-table');
</Script>


<style>
section.woocommerce-customer-details {
    display: none;
}
</style>

    

</div>

<?php get_section('account/product_feed') ?>

<?php get_section('account/basket') ?>

