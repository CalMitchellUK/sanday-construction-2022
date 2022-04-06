<?php
/**
 * The default template.
 *
 * @package sanday
 * @since 0.0.0
 */

get_header();

?>

<div class="container my-8">

	<div class="max-w-sm m-8">
		<div class="text-5xl md:text-9xl border-primary border-b">404</div>
		<div class="w-16 h-1 bg-purple-light my-3 md:my-6"></div>
		<p class="text-2xl md:text-3xl font-light mb-8"><?php _e( 'Sorry, the page you are looking for could not be found.', 'tailpress' ); ?></p>
		<a href="<?php echo esc_url( get_bloginfo( 'url' ) ); ?>" class="bg-primary px-4 py-2 rounded text-white">
			<?php _e( 'Go Home', 'tailpress' ); ?>
		</a>
	</div>

</div>

<?php
get_footer();
