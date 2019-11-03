<?php
/**
 * My Account Dashboard
 *
 * Shows the first intro screen on the account dashboard.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/dashboard.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @author      WooThemes
 * @package     WooCommerce/Templates
 * @version     2.6.0
 */

if (!defined('ABSPATH'))

    exit; // Exit if accessed directly

$customer_id = get_current_user_id();


$address_data = [

    'company' => get_user_meta($customer_id, 'billing_company', true),

    'address_1' => get_user_meta($customer_id, 'billing_address_1', true),

    'address_2' => get_user_meta($customer_id, 'billing_address_2', true),

    'city' => get_user_meta($customer_id, 'billing_city', true),

    'state' => get_user_meta($customer_id, 'billing_state', true),

    'postcode' => get_user_meta($customer_id, 'billing_postcode', true),

    'country' => get_user_meta($customer_id, 'billing_country', true),

];

$formatted_address = WC()->countries->get_formatted_address($address_data);

$formatted_address = explode('<br/>', $formatted_address);

$formatted_address = implode(',', $formatted_address);

$billing_phone = get_user_meta($customer_id, 'billing_phone', true);

$billing_email = get_user_meta($customer_id, 'billing_email', true);

?>
    
    <!-- <h2 class="account_heading_top">Your Account</h2> -->

<?php echo $address_data['company'] ? "<h3>{$address_data['company']}</h3>" : '' ?>

    <address>

        <?php echo $formatted_address ? $formatted_address : 'You have not added an address yet' ?>

    </address>

<?php if ($billing_phone || $billing_email) : ?>

    <div class="contact_details">

        <?php echo $billing_email ? "<b>E.</b> $billing_email" : ''; ?>

        <?php echo $billing_phone ? "<b>T.</b> $billing_phone" : ''; ?>

    </div>

<?php endif; ?>

<div class="account_links">

    <h3 class="account_heading"> My Account</h3>

    <a href="<?php echo esc_url( wc_get_endpoint_url( 'edit-address', 'billing' ) ); ?>" class="btn btn-danger btn-sm">Address</a>

    <a href="<?php echo esc_url( wc_get_endpoint_url( 'edit-account') ); ?>" class="btn btn-danger btn-sm">Account Details</a>

    <a href="<?php echo esc_url( wc_get_endpoint_url( 'orders') ); ?>" class="btn btn-danger btn-sm">Your Orders</a>

    <br />
    <h3 class="account_heading_two">Order Now</h3>
    <br />

    <a href="/price-list/" class="btn btn-danger btn-sm">Price List</a>

    <a href="/quick-order/" class="btn btn-danger btn-sm">Quick Order</a>

    <a href="/faqs/" class="btn btn-danger btn-sm">FAQs</a>

</div>
