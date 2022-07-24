<?php
/**
 * The default template.
 *
 * @package sanday
 * @since 0.0.0
 */

get_header();

?>

<div class="container px-2.5 xl:px-5 py-8 xl:py-12">

	<?php
	if ( have_posts() ) {
		while ( have_posts() ) {
			the_post();
			?>
			<article id="post-<?php the_ID(); ?>" <?php post_class( 'mb-12' ); ?>>

			<?php if ( is_search() || is_archive() ) : ?>

				<header class="entry-header mb-10">
					<?php the_title( sprintf( '<h2 class="entry-title text-xl lg:text-4xl"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
				</header>

				<div class="entry-summary">
					<?php the_excerpt(); ?>
				</div>

			<?php else : ?>

				<header class="entry-header mb-10">
					<?php the_title( '<h1 class="entry-title text-2xl lg:text-5xl">', '</h1>' ); ?>
				</header>

				<div class="entry-content">
					<?php
					the_content();
					?>
				</div>

			<?php endif; ?>

			</article>
			<?php
		}
	}
	?>

</div>

<?php
get_footer();
