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
                <h1> Price List</h1>
                <?php the_content(); ?>
                
</div>



              




                <div class="row text-center flex-align-lg-center ">

                    <div class="<?php echo has_post_thumbnail() ? 'col-lg-8 ' : 'col-xs-12'; ?>">

                        <h1><?php //the_title(); ?></h1>

                        <?php //the_content(); ?>

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