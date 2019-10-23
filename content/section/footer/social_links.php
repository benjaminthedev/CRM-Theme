<?php
/**
 * Created by PhpStorm.
 * User: benjaminthdev
 * Date: 11/07/2017
 * Time: 15:50
 */ ?>

<ul class="social_links clearfix">

    <?php

    while (have_rows('social_links', 'options')) : the_row();

        $icon = get_sub_field('icon');

        $link = get_sub_field('link');

        $extra_attributes = get_sub_field('extra_attributes');

        echo $icon && $link ? "<li><a href='$link' target='_blank' $extra_attributes>$icon</a></li>" : '';

    endwhile; ?>

</ul>
