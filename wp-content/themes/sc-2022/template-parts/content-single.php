<?php
/**
 * Single Content
 *
 * @package sanday
 * @since 0.0.0
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header mb-10">
		<?php the_title( sprintf( '<h1 class="entry-title text-2xl lg:text-5xl leading-tight"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>
	</header>

	<div class="entry-content">
		<?php the_content(); ?>

		<?php
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

</article>
