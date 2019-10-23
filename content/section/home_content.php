<?php
/**
 * Created by PhpStorm.
 * User: benjaminthdev
 * Date: 10/07/2017
 * Time: 16:24
 */
?>

<section class="home_content warning_bg">

    <div class="content_inner">

        <div class="logo"><?php echo get_img('logo_circle.png', 'CRM Logo Circle') ?></div>

        <h1><?php the_title(); ?></h1>

        <?php the_content(); ?>

    </div>

</section>