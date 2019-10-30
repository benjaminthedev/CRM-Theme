<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
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
 * @version 3.0.0
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

global $product, $post;

$secondary_title = get_field('secondary_title');

$ean = get_post_meta($post->ID, '_ean', true);

$price_html = $product->get_price_html();

$rrp = get_post_meta($product->get_id(), '_rrp_price', true);

$rrp = $rrp ? apply_filters('woocommerce_variable_price_html', wc_price($rrp) . $product->get_price_suffix(), $product) : false;

$rrp_html = $rrp ? apply_filters('woocommerce_get_price_html', $rrp, $product) : false;

$rrp_html = $rrp_html !== $price_html ? $rrp_html : false;

$price_html_text = $rrp_html ? 'Discounted Price' : 'Our Price';

?>

<!-- <div <?php //post_class('col-xxl-6 col-lg-4 col-md-4'); ?>> -->

<div <?php post_class('newProduct'); ?>>

    <!-- <div class="row flex-align-sm-center"> -->
        <div class="new-wrap">

<div class="product-wrap">
        <!-- <div class="col-auto"> -->
            <div class="image-wrap">
                <?php echo preg_replace('/(<[^>]+) sizes=".*?"/i', '$1', woocommerce_get_product_thumbnail()); ?>
            </div>

        <div class="product-info">
        
        <div class="info-cost">
            <div class="title">
                <?php the_title(); ?>
                <?php echo $secondary_title ? "<div class='subtitle'>$secondary_title</div>" : ''; ?>
            </div>

            <div class="product-sku">
                <?php echo $ean ? "<div class='ean'>Product Code:<br> $ean</div>" : ''; ?>
                <p class="mb-0">SKU: <?php echo $product->get_sku(); ?></p>    
            </div>  

            <div class="price">
                <?php echo $rrp_html ? "<div class='rrp'>Our Price $rrp_html</div> " : ""; ?>
                <?php echo $price_html ? "<div class='our_price'>$price_html_text $price_html</div> " : ""; ?>
           </div>
        </div>

        <div class="checkouts">
            <?php
            get_section('account/add_to_cart', ['product' => $product, 'class' => 'hidden-xxxxl-up']);
            ?>
        </div>

        </div>

        <div class="col-auto hidden-xxxl-down">

            <?php

            get_section('account/add_to_cart', ['product' => $product, 'class' => '']);

            ?>

        </div>
        </div>
    </div>

</div>

<style>
/* .post-type-archive-product ul.products{
    display: flex !important;
}

.post-type-archive-product div#primary {
    width: 70%;
    float: left;
    margin-top: 70px;
    padding: 30px;
}

.post-type-archive-product div#sidebar {
    width: 30%;
    float: left;
    padding: 30px;
    margin-top: 70px;
}

.post-type-archive-product nav.woocommerce-breadcrumb {
    display: none;
}

.post-type-archive-product header.woocommerce-products-header {
    display: none;
}

.post-type-archive-product img.attachment-woocommerce_thumbnail.size-woocommerce_thumbnail {
    width: 60%;
}
.post-type-archive-product form.woocommerce-ordering {
    display: none;
} */


</style>
