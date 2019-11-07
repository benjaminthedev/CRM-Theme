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

$price_html_text = $rrp_html ? '' : '';

?>


<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">SKU</th>
      <th scope="col">Image</th>
      <th scope="col">Product</th>
      <th scope="col">Quantity Available</th>
      <th scope="col">Quantity</th>
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

      
      <td class="quantity-available">
          <?php echo $product->get_stock_quantity(); ?>
      </td>


      <td class="quant">
          <?php if ( $max_value && $min_value === $max_value ) {
	?>
	<div class="quantity hidden">
		<input type="hidden" id="<?php echo esc_attr( $input_id ); ?>" class="qty" name="<?php echo esc_attr( $input_name ); ?>" value="<?php echo esc_attr( $min_value ); ?>" />
	</div>
	<?php
} else {
	/* translators: %s: Quantity. */
	$label = ! empty( $args['product_name'] ) ? sprintf( esc_html__( '%s quantity', 'woocommerce' ), wp_strip_all_tags( $args['product_name'] ) ) : esc_html__( 'Quantity', 'woocommerce' );
	?>
	<div class="quantity">
		<?php do_action( 'woocommerce_before_quantity_input_field' ); ?>
		<label class="screen-reader-text" for="<?php echo esc_attr( $input_id ); ?>"><?php echo esc_attr( $label ); ?></label>
		<input
			type="number"
			id="<?php echo esc_attr( $input_id ); ?>"
			class="<?php echo esc_attr( join( ' ', (array) $classes ) ); ?>"
			step="<?php echo esc_attr( $step ); ?>"
			min="<?php echo esc_attr( $min_value ); ?>"
			max="<?php echo esc_attr( 0 < $max_value ? $max_value : '' ); ?>"
			name="<?php echo esc_attr( $input_name ); ?>"
			value="<?php echo esc_attr( $input_value ); ?>"
			title="<?php echo esc_attr_x( 'Qty', 'Product quantity input tooltip', 'woocommerce' ); ?>"
			size="1"
			inputmode="<?php echo esc_attr( $inputmode ); ?>" />
		<?php do_action( 'woocommerce_after_quantity_input_field' ); ?>
	</div>
	<?php
} 
?>
      </td>
      
      <td>
        <?php echo $rrp_html ? "<div class='rrp'> $rrp_html</div> " : ""; ?>
        <?php echo $price_html ? "<div class='our_price'>$price_html_text $price_html</div> " : ""; ?>
    </td>


    <td>
        <div class="add-to-cart new-add-to-cart"><?php
                echo sprintf( '<a href="%s" data-quantity="1" class="%s" %s>%s</a>',
                    esc_url( $product->add_to_cart_url() ),
                    esc_attr( implode( ' ', array_filter( array(
                        'button', 'product_type_' . $product->get_type(),
                        $product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
                        $product->supports( 'ajax_add_to_cart' ) ? 'ajax_add_to_cart' : '',
                    ) ) ) ),
                    wc_implode_html_attributes( array(
                        'data-product_id'  => $product->get_id(),
                        'data-product_sku' => $product->get_sku(),
                        'aria-label'       => $product->add_to_cart_description(),
                        'rel'              => 'nofollow',
                    ) ),
                    esc_html( $product->add_to_cart_text() )
                );
              ?></div>
    </td>
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
        width: 7%;      
    
    }
    td.titles{
        width:34%;
    }

    .main-section-one {
            background: #fff;
    }

    td.quantity-available {
        width: 10%;
    }
    td.quant {
        width: 10%;
    }
    .page-id-5380 input[type="number"] {
        width: 50%;
    }

    /* Add to cart custom */

    .add-to-cart.new-add-to-cart {
        padding-top: 10px;
    }

    .add-to-cart .new-add-to-cart .woocommerce a.button{
        padding: 10px !important;
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
