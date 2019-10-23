<?php

get_header();

get_hero('hero_slider');

get_section('brands_slider', [

    'brands_slider' => get_field('brands_slider', 'options')

]);

if (have_posts())
    while (have_posts()) : the_post();
        get_section('home_content');
    endwhile;


get_section('home_tag_line');


get_section('link_blocks');

get_section('product_links');

get_section('new_arrivals');

get_section('contact_form');

//get_flexi_content();

get_footer();

?>
