<?php
/**
 * Created by PhpStorm.
 * User: benjaminthdev
 * Date: 20/07/2017
 * Time: 13:54
 */

$page = isset($_GET['index']) ? (int)$_GET['index'] : 1;

$per_page = isset($_GET['per_page']) ? (int)$_GET['per_page'] : 18;

$cat = isset($_GET['category']) ? (int)$_GET['category'] : '';

$search = isset($_GET['search']) ? $_GET['search'] : false;

$args = [

    'post_type' => 'product',

    'posts_per_page' => $per_page,

    'paged' => $page,

    'meta_query' => [

        [

            'key' => '_stock_status',

            'value' => 'instock',

            'compare' => '=',

        ]

    ]

];

if ($cat)

    $args['tax_query'] = [

        [

            'taxonomy' => 'product_cat',

            'field' => 'slug',

            'terms' => $cat,

        ]

    ];

if ($search) $args['s'] = $search;

$query = new WP_Query($args);

$product_cats = get_terms(['taxonomy' => 'product_cat',]);

$per_page_filter = per_page($query);

?>

<div class="products" id="product_feed_loader"

     data-page='<?php echo $page; ?>'

     data-per_page='<?php echo $per_page; ?>'

     data-cat='<?php echo $cat ? json_encode($cat) : ''; ?>'

     data-search='<?php echo $search; ?>'

>

    <?php get_section('loader') ?>

    <div class="product_filter">

        <div class="container">

            <div class="product_filter_wrap">

                <div class="per_page">

                    <?php echo $per_page_filter ?>

                </div>

                <div class="row">

                    <div class="col-md-6">

                        <select name="product_cat_filter" id="product_cat_filter" title="product_cat_filter" >

                            <option value="">Select Category</option>

                            <?php

                            foreach (categories_to_tree($product_cats) as $product_cat)

                                output_category_option_tree($product_cat, $cat);

                            ?>

                        </select>

                    </div>

                    <div class="col-md-6">

                        <div class="search_wrap">

                            <form class="search_form">

                                <input type="text" name="search" placeholder="Search" class="form-control" value="<?php echo $search; ?>">

                                <button type="submit"><i class="fa fa-search"></i></button>

                            </form>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <div class="container">

        <?php if ($query->have_posts()) : ?>


            <div class="row justify-content-md-start justify-content-sm-center product_row" id="product_row">

                <?php while ($query->have_posts()) : $query->the_post(); ?>

                    <?php wc_get_template_part('content', 'product'); ?>

                <?php endwhile; ?>

            </div>

        <?php else : ?>

            <?php do_action('woocommerce_no_products_found'); ?>

        <?php endif ?>

        <?php wp_reset_postdata(); ?>

    </div>

    <div class="pagination">

        <div class="container">

            <div class="pagination_wrap">

                <div class="per_page">

                    <?php echo $per_page_filter ?>

                </div>

                <ul id="pagination">

                    <?php echo the_product_pagination($query); ?>

                </ul>

            </div>

        </div>

    </div>

</div>