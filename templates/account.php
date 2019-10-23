<?php
/**
 * Created by PhpStorm.
 * User: benjaminthdev
 * Date: 18/07/2017
 * Time: 14:31
 * Template Name: Account
 */

get_header();

if (have_posts())

    while (have_posts()) : the_post(); ?>

        <?php the_content(); ?>

    <?php endwhile;

get_section('contact_form');

get_footer();
