<?php
/**
 * Created by PhpStorm.
 * User: benjaminthdev
 * Date: 11/07/2017
 * Time: 17:28
 * Template Name: Contact
 */

get_header();

if (have_posts())

    while (have_posts()) : the_post(); ?>

        <section class="link_blocks contact_page">

            <div class="container">

                <div class="row">

                    <div class="col-lg-6">

                        <div class="link_block content_block warning_bg">

                            <?php echo get_img('small_logo_body.png', 'Contact Us Logo') ?>

                            <h1><?php get_the_title(); ?></h1>

                            <?php

                            $address = get_field('address', 'options');

                            $company_number = get_field('company_number', 'options');

                            $email = get_field('email', 'options');

                            $email_attributes = get_field('email_attributes', 'options');

                            $telephone_number_attributes = get_field('telephone_number_attributes', 'options');

                            $telephone_number = get_field('telephone_number', 'options');

                            echo $address ? "<div class='contact_block'>$address</div>" : '' ?>

                            <?php if ($email || $telephone_number) : ?>

                                <div class="contact_block">

                                    <?php echo $email ? "<a href='mailto:$email' $email_attributes><b>e.</b>$email</a>" : '' ?>

                                    <?php echo $telephone_number ? "<a href='tel:$telephone_number' $telephone_number_attributes><b>t.</b>$telephone_number</a>" : '' ?>

                                </div>

                            <?php endif; ?>

                            <?php echo $company_number ? "<div class='contact_block'>$company_number</div>" : '' ?>

                        </div>

                    </div>

                    <div class="col-lg-6 flex-lg-first">

                        <div class="link_block" id="contact_map">


                        </div>

                    </div>

                </div>

            </div>

        </section>

        <?php get_section('link_blocks'); ?>

    <?php endwhile;

get_section('brands_slider', [

    'brands_slider' => get_field('brands_slider', 'options')

]);

get_section('contact_form');

get_footer();