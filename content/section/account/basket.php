<?php
/**
 * Created by PhpStorm.
 * User: benjaminthdev
 * Date: 20/07/2017
 * Time: 16:44
 */ ?>

<section class="account_basket" id="account_basket">

    <div class="container">

        <div class="basket_wrapper">

            <?php get_section('loader') ?>

            <div class="title">

                <h2>Shopping Basket</h2>

                <?php echo !empty($_REQUEST['update-product']) && empty($_REQUEST['remove-product']) ? '<h3>Basket Updated</h3>' : ''; ?>

                <?php echo empty($_REQUEST['update-product']) && !empty($_REQUEST['remove-product']) ? '<h3>Basket Item Removed</h3>' : ''; ?>

            </div>

            <div class="basket_contents">

                <div class="row justify-content-md-start justify-content-sm-center product_row" id="basket_row">

                    <?php

                    if (WC()->cart->get_cart())

                        foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) :

                            $_product = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);

                            $product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);

                            $secondary_title = get_field('secondary_title', $product_id);

                            $ean = get_post_meta($product_id, '_ean', true);

                            $price_html = WC()->cart->get_product_subtotal($_product, $cart_item['quantity']);

                            $rrp = (float)get_post_meta($_product->get_id(), '_rrp_price', true) * (int)$cart_item['quantity'];

                            $rrp = $rrp ? apply_filters('woocommerce_variable_price_html', wc_price($rrp) . $_product->get_price_suffix(), $_product) : false;

                            $rrp_html = $rrp ? apply_filters('woocommerce_get_price_html', $rrp, $_product) : false;

                            $rrp_html = $rrp_html !== $price_html ? $rrp_html : false;

                            $price_html_text = $rrp_html ? 'Discounted Total' : 'Total';

                            $image = $_product->get_image('shop_catalog');

                            ?>

                            <div <?php post_class('col-xxl-6 col-lg-4 col-md-6', $product_id); ?>>

                                <div class="row flex-align-sm-center">

                                    <div class="col-auto">

                                        <?php echo $image; ?>

                                    </div>

                                    <div class="col">

                                        <div class="title">

                                            <?php echo get_the_title($product_id); ?>

                                            <?php echo $secondary_title ? "<div class='subtitle'>$secondary_title</div>" : ''; ?>

                                        </div>

                                        <?php echo $ean ? "<div class='ean'>Product Code:<br> $ean</div>" : ''; ?>

                                        <div class="price">

                                            <?php echo $rrp_html ? "<div class='rrp'>Total $rrp_html</div> " : ""; ?>

                                            <?php echo $price_html ? "<div class='our_price'>$price_html_text $price_html</div> " : ""; ?>

                                        </div>

                                        <?php

                                        get_section('account/edit_cart_item', [

                                            'product' => $_product,

                                            'cart_item_key' => $cart_item_key,

                                            'cart_item' => $cart_item,

                                            'class' => 'hidden-xxxxl-up'

                                        ]);

                                        ?>

                                        <?php

                                        echo apply_filters('woocommerce_cart_item_remove_link', sprintf(

                                            '<a href="%s" class="remove hidden-xxxxl-up btn btn-sm btn-danger" aria-label="%s" data-product_id="%s" data-product_sku="%s">Remove</a>',

                                            esc_url(add_query_arg([

                                                'update-product' => false,

                                                'add-to-cart' => false,

                                                'process-order' => false,

                                                'remove-product' => $cart_item_key

                                            ])) . '#account_basket',

                                            __('Remove this item', 'woocommerce'),

                                            esc_attr($product_id),

                                            esc_attr($_product->get_sku())

                                        ), $cart_item_key);

                                        ?>


                                    </div>

                                    <div class="col-auto hidden-xxxl-down">

                                        <?php

                                        get_section('account/edit_cart_item', [

                                            'product' => $_product,

                                            'cart_item_key' => $cart_item_key,

                                            'cart_item' => $cart_item,

                                            'class' => false

                                        ]);

                                        ?>

                                        <?php

                                        echo apply_filters('woocommerce_cart_item_remove_link', sprintf(

                                            '<a href="%s" class="remove btn btn-sm btn-danger" aria-label="%s" data-product_id="%s" data-product_sku="%s">Remove</a>',

                                            esc_url(add_query_arg([

                                                'update-product' => false,

                                                'add-to-cart' => false,

                                                'process-order' => false,

                                                'remove-product' => $cart_item_key

                                            ])) . '#account_basket',

                                            __('Remove this item', 'woocommerce'),

                                            esc_attr($product_id),

                                            esc_attr($_product->get_sku())

                                        ), $cart_item_key);

                                        ?>

                                    </div>

                                </div>

                            </div>

                        <?php endforeach; ?>

                </div>

            </div>

            <div class="basket_totals">

                <div class="total">

                    <?php if (WC()->cart->get_cart()) : ?>

                        Total <?php echo WC()->cart->get_cart_total(); ?>

                    <?php else : ?>

                        You currently have no items in your cart.

                    <?php endif ?>

                </div>

                <?php if (WC()->cart->get_cart()) : ?>

                    <?php print_object(WC()->customer->get_billing_address(), true); ?>

                    <a href="<?php echo esc_url(add_query_arg([

                            'update-product' => false,

                            'add-to-cart' => false,

                            'process-order' => 1,

                            'remove-product' => false

                        ])); ?>" class="btn btn-danger" id="process_order">

                        Place Order

                    </a>

                <?php endif ?>

            </div>

        </div>

    </div>

</section>