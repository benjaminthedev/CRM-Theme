oldproduct

<!-- <div <?php //post_class('col-xxl-6 col-lg-4 col-md-4'); ?>> -->

<div <?php post_class('newProduct'); ?>>

    <!-- <div class="row flex-align-sm-center"> -->
        <div class="new-wrap">

<div class="product-wrap">
        <!-- <div class="col-auto"> -->
            <div class="image-wrap">
                <?php echo preg_replace('/(<[^>]+) sizes=".*?"/i', '$1', woocommerce_get_product_thumbnail()); ?>
            </div>

        <div class="product-info">
        
        <div class="info-cost">

            <div class="product-sku">
                <?php echo $ean ? "<div class='ean'>Product Code:<br> $ean</div>" : ''; ?>
                <p class="mb-0">SKU: <?php echo $product->get_sku(); ?></p>    
            </div>  


            <div class="title">
                <?php the_title(); ?>
                <?php echo $secondary_title ? "<div class='subtitle'>$secondary_title</div>" : ''; ?>
            </div>



            <div class="price">
                <?php echo $rrp_html ? "<div class='rrp'>Our Price $rrp_html</div> " : ""; ?>
                <?php echo $price_html ? "<div class='our_price'>$price_html_text $price_html</div> " : ""; ?>
           </div>
        </div>

        <div class="checkouts">
            <?php
            get_section('account/add_to_cart', ['product' => $product, 'class' => 'hidden-xxxxl-up']);
            ?>
        </div>

        </div>

        <div class="col-auto hidden-xxxl-down">

            <?php

            get_section('account/add_to_cart', ['product' => $product, 'class' => '']);

            ?>

        </div>
        </div>
    </div>

</div>
