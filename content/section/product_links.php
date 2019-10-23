<?php


$rows = [

    'newly_reduced_stock',

    'back_in_stock'

];

?>

<section class="link_blocks">

    <div class="container">

        <div class="row">

            <?php foreach ($rows as $row) : ?>

                <?php if (!have_rows($row, 'options')) continue; ?>

                <div class="col-lg-6">

                    <div class="product_slider" <?php echo "id='$row''" ?>>

                        <ul class="slides clearfix">

                            <?php while (have_rows($row, 'options')) : the_row();

                                $product = get_sub_field('product');

                                $image = get_sub_field('image');

                                if (!$product || !$image)
                                    continue;

                                if (!is_array($image)) {
                                    $image = [
                                        'alt' => get_post_meta($image, '_wp_attachment_image_alt', true),
                                        'sizes' => [
                                            'link_block_thumb' => wp_get_attachment_image_src($image, 'link_block_thumb')[0]
                                        ]
                                    ];
                                }

                                $title = get_the_title($product);

                                $product = wc_get_product($product);

                                $price_html = $product->get_price_html();

                                $rrp = get_post_meta($product->get_id(), '_rrp_price', true);

                                $rrp = $rrp ? apply_filters('woocommerce_variable_price_html', wc_price($rrp) . $product->get_price_suffix(), $product) : false;

                                $rrp_html = $rrp ? apply_filters('woocommerce_get_price_html', $rrp, $product) : false;

                                $rrp_html = $rrp_html !== $price_html ? $rrp_html : false;

                                $price_html_text = $rrp_html ? 'Discounted Price' : 'Our Price';

                                ?>

                                <li>

                                    <div class="link_block">

                                        <?php echo get_img($image['sizes']['link_block_thumb'], $image['alt'], false); ?>

                                        <?php if ($title) : ?>

                                            <div class="title">

                                                <span class="title_el"><?php echo $title; ?></span>

                                                <?php // echo $rrp_html ? "<span class='rrp'>Our Price $rrp_html</span> " : ""; ?>

                                                <?php // echo $price_html ? "<span class='price'>$price_html_text $price_html</span> " : ""; ?>

                                                <div class="flex_control"

                                                     data-control="next"

                                                    <?php echo "data-target='$row''" ?>>

                                                    <i class="fa fa-angle-right" aria-hidden="true"></i>

                                                </div>

                                                <div class="flex_control"

                                                     data-control="prev"

                                                    <?php echo "data-target='$row''" ?>>

                                                    <i class="fa fa-angle-left" aria-hidden="true"></i>

                                                </div>

                                            </div>

                                        <?php endif; ?>

                                    </div>

                                </li>

                            <?php endwhile; ?>

                        </ul>

                    </div>
                </div>

            <?php endforeach; ?>

        </div>

    </div>

</section>
