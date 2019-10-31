<?php
/**

 * User: benjaminthdev
 * Date: 18/07/2017
 * Time: 14:31
 * Template Name: Account
 */

get_header();

if (have_posts())

    while (have_posts()) : the_post(); ?>

        <?php the_content(); ?>
    <?php endwhile;?>

    <?php if( have_rows('repeater_field_name') ): ?>

	<ul class="slides">

	<?php while( have_rows('repeater_field_name') ): the_row(); 

		// vars
		$image = get_sub_field('image');
		$content = get_sub_field('content');
		$link = get_sub_field('link');

		?>

		<li class="slide">

			<?php if( $link ): ?>
				<a href="<?php echo $link; ?>">
			<?php endif; ?>

				<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt'] ?>" />

			<?php if( $link ): ?>
				</a>
			<?php endif; ?>

		    <?php echo $content; ?>

		</li>

	<?php endwhile; ?>

	</ul>

<?php endif; ?>



<? get_footer(); ?>

<style>

    .woocommerce-account div#product_feed_loader,
    .woocommerce-account section#account_basket {
    display: none;
}
</style>
