<?php

get_header();

if (have_posts())

    while (have_posts()) : the_post(); ?>

        <section class="content_section">

            <div class="container">

                <div class="row">

                    <div class="<?php echo has_post_thumbnail() ? 'col-lg-6' : 'col-xs-12'; ?>">

                        <h1><?php the_title(); ?></h1>

                        <?php the_content(); ?>

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