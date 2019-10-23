<?php
/**
 * Created by PhpStorm.
 * User: benjaminthdev
 * Date: 20/07/2017
 * Time: 10:37
 * @var $product
 * @var $class
 */

if (!$product && !$product->is_type('simple') && !$product->is_purchasable() && !$product->is_in_stock() && $product->is_sold_individually())

    exit;

?>

<form action="<?php echo esc_url(add_query_arg([

    'update-product' => false,

    'add-to-cart' => get_the_ID(),

    'process-order' => false,

    'remove-product' => false


])) ?>#account_basket" class="cart <?php echo $class ? $class : ''; ?>" method="post" enctype="multipart/form-data">

    <?php echo woocommerce_quantity_input( array(), $product, false ); ?>

    <button type="submit" class="btn btn-danger">add</button>

</form>
