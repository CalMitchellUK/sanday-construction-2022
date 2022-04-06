<?php
/**
 * The default template.
 *
 * @package sanday
 * @since 0.0.0
 */

get_header();

?>

<div class="container my-8 px-2.5 xl:px-5">

	<?php if ( have_posts() ) : ?>
		<?php
		while ( have_posts() ) :
			the_post();
			?>

			<?php get_template_part( 'template-parts/content', get_post_format() ); ?>

		<?php endwhile; ?>

	<?php endif; ?>

</div>

<?php
get_footer();
