<?php

if (!have_rows('link_blocks'))

    return;


?>

<section class="link_blocks">

    <div class="container">

        <div class="row">

            <?php while (have_rows('link_blocks')) : the_row();

                $title = get_sub_field('title');

                $image = get_sub_field('image');

                $link_type = get_sub_field('link_type');

                $link = $link_type !== 'account' ? get_sub_field("{$link_type}_link") : get_permalink(get_option('woocommerce_myaccount_page_id'));

                $link = $link_type === 'category' ? get_term_link($link) : $link;

                $link_target = $link_type === 'external' ? 'target="_blank"' : '';


                if (!$image || !$link)

                    continue;

                ?>

                <div class="col-lg-6">

                    <a href="<?php echo $link; ?>" class="link_block" <?php echo $link_target; ?>>

                        <?php echo get_img($image['sizes']['link_block_thumb'], $image['alt'], false); ?>

                        <?php echo $title ? "<div class='title'>$title</div>" : ''; ?>

                    </a>

                </div>

            <?php endwhile; ?>

        </div>

    </div>

</section>
