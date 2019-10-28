<?php
/**

 * User: benjaminthdev
 * Date: 06/07/2017
 * Time: 09:30
 * Template Name: FAQ's
 */

get_header();

if (have_posts())

    while (have_posts()) : the_post(); ?>

        <section class="content_section">

            <div class="container">

                <div class="row">

                    <div class="<?php echo has_post_thumbnail() ? 'col-lg-6' : 'col-xs-12'; ?>">

                        <h1><?php the_title(); ?></h1>

                        <?php

                        if (have_rows('faqs'))

                            while (have_rows('faqs')) : the_row();

                                $title = get_sub_field('title');

                                if (have_rows('faqs_block'))

                                    get_section('faq/faq_block', [
                                        'title' => $title
                                    ]);

                            endwhile;;

                        ?>

                    </div>

                    <?php if (has_post_thumbnail()) : ?>

                        <div class="col-lg-6 flex-lg-first text-center">

                            <?php the_post_thumbnail('full'); ?>

                        </div>

                    <?php endif; ?>

                </div>

            </div>

        </section>

    <?php endwhile;

get_section('new_arrivals');

get_section('contact_form');

get_footer();