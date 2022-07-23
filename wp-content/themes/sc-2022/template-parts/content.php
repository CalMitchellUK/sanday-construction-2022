<?php
/**
 * Content Loop
 *
 * @package sanday
 * @since 0.0.0
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'mb-12' ); ?>>

	<header class="entry-header mb-10">
		<?php the_title( sprintf( '<h2 class="entry-title text-2xl md:text-3xl leading-tight"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
	</header>

	<?php if ( is_search() || is_archive() ) : ?>

		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div>

	<?php else : ?>

		<div class="entry-content">
			<?php
			the_content();

			wp_link_pages(
				array(
					'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'tailpress' ) . '</span>',
					'after'       => '</div>',
					'link_before' => '<span>',
					'link_after'  => '</span>',
					'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'tailpress' ) . ' </span>%',
					'separator'   => '<span class="screen-reader-text">, </span>',
				)
			);
			?>
		</div>

	<?php endif; ?>

</article>
