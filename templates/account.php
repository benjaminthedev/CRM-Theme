<?php
/**

 * User: benjaminthdev
 * Date: 18/07/2017
 * Time: 14:31
 * Template Name: Account
 */

get_header();?>




<?php if (have_posts())

    while (have_posts()) : the_post(); ?>

        <?php the_content(); ?>
    <?php endwhile;?>












<?php get_footer(); ?>

<style>

    .woocommerce-account div#product_feed_loader,
    .woocommerce-account section#account_basket {
    display: none;
}
</style>

<script>

    </script>