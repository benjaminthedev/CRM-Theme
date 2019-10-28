<?php
/**

 * User: benjaminthdev
 * Date: 13/07/2017
 * Time: 09:29
 * Template Name: Whole Sale Order Form Page
 */

get_header();

if (have_posts())

    while (have_posts()) : the_post(); ?>

        <section class="content_section info_bg">

            <div class="container">

            <h2>Upload your order</h2>

            <?php echo do_shortcode('[quick_order]'); ?>
            

                <div class="row text-center flex-align-lg-center ">

                    <div class="<?php echo has_post_thumbnail() ? 'col-lg-8 ' : 'col-xs-12'; ?>">

                        <h1><?php the_title(); ?></h1>

                        <?php the_content(); ?>

                    </div>

                    <?php if (has_post_thumbnail()) : ?>

                        <div class="col-lg-4 flex-lg-first text-left">

                            <?php the_post_thumbnail('full'); ?>

                        </div>

                    <?php endif; ?>

                </div>

            </div>

        </section>

        <?php if(have_rows('team')) get_section('team_section'); ?>

    <?php endwhile;

get_section('new_arrivals');

get_section('contact_form');

get_footer();