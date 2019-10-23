<?php
/**
 * Created by PhpStorm.
 * User: benjaminthdev
 * Date: 10/07/2017
 * Time: 21:03
 */

if (!$new_arrivals = get_field('new_arrivals', 'options'))

    return;

$query = new WP_Query([

    'post_type' => 'product',

    'posts_per_page' => 4,

    'orderby' => 'rand',

    'post__in' => $new_arrivals

]);

if (!$query->have_posts())

    return;




?>


<section class="new_arrivals">

    <div class="container">

        <h3 class="section_title">New! Just arrived</h3>

        <div class="product_feed row">

            <?php while ($query->have_posts()) : $query->the_post();

                global $post;

                $title = get_the_title();

                $secondary_title = get_field('secondary_title');

                $product = wc_get_product($post);

                $price_html = $product->get_price_html();

                $rrp = get_post_meta($product->get_id(), '_rrp_price', true);

                $rrp = $rrp ? apply_filters('woocommerce_variable_price_html', wc_price($rrp) . $product->get_price_suffix(), $product) : false;

                $rrp_html = $rrp ? apply_filters('woocommerce_get_price_html', $rrp, $product) : false;

                $rrp_html = $rrp_html !== $price_html ? $rrp_html : false;

                $price_html_text = $rrp_html ? 'Discounted Price' : 'Our Price';

                ?>

                <div class="col-lg-3 col-md-6">

                    <div class="product">

                        <?php echo preg_replace('/(<[^>]+) sizes=".*?"/i', '$1', woocommerce_get_product_thumbnail()); ?>

                        <?php echo "<h4>$title<span>$secondary_title</span></h4>" ?>

                    </div>

                </div>

            <?php endwhile; ?>

            <?php wp_reset_postdata(); ?>

        </div>

    </div>

</section>