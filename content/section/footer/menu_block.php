<?php
/**

 * User: benjaminthdev
 * Date: 11/07/2017
 * Time: 15:24
 * @var $menu
 */
?>

<div class="col menu_block">

    <?php echo "<h5>{$menu->name}</h5>"?>

    <?php wp_nav_menu(['menu' => $menu->slug,'menu_class' => 'menu clearfix']); ?>

</div>

