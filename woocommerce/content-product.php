<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.0.0
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

global $product, $post;

$secondary_title = get_field('secondary_title');

$ean = get_post_meta($post->ID, '_ean', true);

$price_html = $product->get_price_html();

$rrp = get_post_meta($product->get_id(), '_rrp_price', true);

$rrp = $rrp ? apply_filters('woocommerce_variable_price_html', wc_price($rrp) . $product->get_price_suffix(), $product) : false;

$rrp_html = $rrp ? apply_filters('woocommerce_get_price_html', $rrp, $product) : false;

$rrp_html = $rrp_html !== $price_html ? $rrp_html : false;

$price_html_text = $rrp_html ? 'Discounted Price' : 'Our Price';

?>


<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">SKU</th>
      <th scope="col">Image</th>
      <th scope="col">Product</th>
      <th scope="col">Price</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row" class="skus"><p><?php echo $product->get_sku(); ?></p>    </th>

      <td class="imagess"> <div class="img-pro">
            <?php echo preg_replace('/(<[^>]+) sizes=".*?"/i', '$1', woocommerce_get_product_thumbnail()); ?> 
    </div></td>

      <td class="titles"> <?php the_title(); ?>
                                    <?php echo $secondary_title ? "<div class='subtitle'>$secondary_title</div>" : ''; ?></td>

      
      
      
      <td><?php echo $rrp_html ? "<div class='rrp'> $rrp_html</div> " : ""; ?>
                                    <?php echo $price_html ? "<div class='our_price'>$price_html_text $price_html</div> " : ""; ?></td>
    </tr>
  </tbody>
</table>







<script>

let tablesHeading = document.getElementsByTagName('thead');
console.log(tablesHeading);

tablesHeading[0].style.display = "contents";




</script>



<style>
    /*-- Removing Styles Start --*/

    th.skus {
        width: 18%;
    }
    td.imagess {
        width: 10%;      
    
    }
    td.titles{
        width:60%;
    }

    .main-section-one {
            background: #fff;
    }



    /*-- Removing Styles End --*/




    .wk_quick_order_box {
    margin: 0;
    box-shadow: none;
    padding: 0.563rem 1.25rem;
}

thead{
    display:none;
}

    .img-pro {
    width: 50px;
}
/* .post-type-archive-product ul.products{
    display: flex !important;
}

.post-type-archive-product div#primary {
    width: 70%;
    float: left;
    margin-top: 70px;
    padding: 30px;
}

.post-type-archive-product div#sidebar {
    width: 30%;
    float: left;
    padding: 30px;
    margin-top: 70px;
}

.post-type-archive-product nav.woocommerce-breadcrumb {
    display: none;
}

.post-type-archive-product header.woocommerce-products-header {
    display: none;
}

.post-type-archive-product img.attachment-woocommerce_thumbnail.size-woocommerce_thumbnail {
    width: 60%;
}
.post-type-archive-product form.woocommerce-ordering {
    display: none;
} */


</style>
