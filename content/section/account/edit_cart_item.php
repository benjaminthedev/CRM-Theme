<?php
/**
 * Created by PhpStorm.
 * User: benjaminthdev
 * Date: 20/07/2017
 * Time: 10:37
 * @var $product
 * @var $class
 * @var $cart_item_key
 * @var $cart_item
 */

if(!$class)
    $class ='';

?>

<form action="<?php echo esc_url(add_query_arg([

    'update-product' => $cart_item_key,

    'add-to-cart' => false,

    'process-order' => false,

    'remove-product' => false

])) ?>#account_basket" class="cart <?php echo $class ? $class : ''; ?>"

      method="post" enctype="multipart/form-data">

    <?php

    echo woocommerce_quantity_input([

        'input_value' => $cart_item['quantity'],

    ], $product, false);

    ?>

    <button type="submit" class="btn btn-danger">Update Qty</button>

</form>
