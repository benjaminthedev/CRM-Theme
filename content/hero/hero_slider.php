<?php

if (!have_rows('hero_slider'))

    return;

?>

<header class="hero hero_slider">

    <ul class="slides clearfix">

        <?php while (have_rows('hero_slider')) : the_row();

            $title = get_sub_field('title');

            $image = get_sub_field('image');

            $link_type = get_sub_field('link_type');

            $link = $link_type !== 'account' ? get_sub_field("{$link_type}_link") : get_permalink(get_option('woocommerce_myaccount_page_id'));

            $link = $link_type === 'category' ? get_term_link($link) : $link;

            $link_target = $link_type === 'external' ? 'target="_blank"' : '';

            $link_text = get_sub_field('link_text') ? get_sub_field('link_text') : 'Read More';

            if ($link_type === 'account')

                $link_text = is_user_logged_in() ? 'My Account' : 'Login/Sign up';

            if (!$image)

                continue;

            ?>

            <li <?php echo "style='background-image:url({$image['url']})'" ?>>

                <div class="table">

                    <div class="table-cell middle">

                        <div class="container">

                            <?php echo $title ? "<div class='title'>$title</div>" : ''; ?>

                            <?php echo $link ? "<a href='$link' class='btn btn-danger' $link_target>$link_text</a>" : '' ?>

                        </div>

                    </div>

                </div>

            </li>

        <?php endwhile; ?>

    </ul>

</header>
