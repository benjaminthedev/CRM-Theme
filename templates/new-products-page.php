<?php
/**

 * User: benjaminthdev
 * Date: 
 * Time: 09:29
 * Template Name: New Products Page 2
 */

get_header();

if (have_posts())

    while (have_posts()) : the_post(); ?>

        <section class="content_section info_bg">

            <div class="container">

            <div class="row">
                <div class="col-md-12">
                
                <?php the_content(); ?>
                
</div>



              




      

            </div>

        </section>

        <?php if(have_rows('team')) get_section('team_section'); ?>

    <?php endwhile;

get_section('new_arrivals');

get_section('contact_form');

get_footer();