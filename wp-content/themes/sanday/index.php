<?php
/**
 * The default template.
 *
 * @package sanday
 * @since 0.0.0
 */

get_header();


$banner_image = get_field( 'banner_image' );
if ( $banner_image ) {
	echo '<div id="page-banner-image">';
	echo '<div class="ratio"></div>';
	echo wp_get_attachment_image( $banner_image, 'full' );
	echo '</div>';
}

?>

<div class="container my-8">

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
