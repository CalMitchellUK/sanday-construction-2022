<?php
/**
 * Template Name: Policies
 *
 * @package sanday
 * @since 0.0.0
 */

get_header();

?>

<div class="container mb-10 xl:mb-16 px-2.5 xl:px-5 pt-8 xl:pt-12">

	<?php if ( have_posts() ) : ?>
		<?php
		while ( have_posts() ) :
			the_post();
			?>

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

				<header class="entry-header mb-10">
					<?php the_title( '<h1 class="entry-title text-3xl xl:text-5xl">', '</h1>' ); ?>
				</header>

				<div class="entry-content tinymce xl:w-3/4">
					<?php the_content(); ?>
				</div>

				<?php
				$docs = get_field( 'docs' );
				if ( $docs && count( $docs ) ) {
					echo '<div class="w-full my-10 border-t border-white/10" aria-hidden="true"></div>';
					echo '<ul class="flex flex-wrap items-start">';

					$items = array_map(
						function( $post_id ) {
							// Item.
							$doc_title   = get_the_title( $post_id );
							$description = get_field( 'description', $post_id );
							$files       = get_field( 'files', $post_id );
							return array(
								'id'          => $post_id,
								'doc_title'   => $doc_title,
								'description' => $description,
								'files'       => $files,
							);
						},
						$docs
					);

					// Loop.
					sc_build_file_rows( $items );

					echo '</ul>';
				}
				?>

			</article>


		<?php endwhile; ?>

	<?php endif; ?>

</div>

<?php
get_footer();
