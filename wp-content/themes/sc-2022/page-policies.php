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
					<?php the_title( '<h1 class="entry-title text-2xl lg:text-5xl leading-tight">', '</h1>' ); ?>
				</header>

				<div class="entry-content tiny-mce xl:w-3/4">
					<?php the_content(); ?>
				</div>

				<?php
				$docs = get_field( 'docs' );
				if ( $docs && count( $docs ) ) {
					echo '<div class="w-full my-10 border-t border-white/10" aria-hidden="true"></div>';
					echo '<ul class="flex flex-wrap items-start">';
					foreach ( $docs as $doc ) {
						$doc_title = get_the_title( $doc );

						echo '<li class="w-full mb-6 px-4 py-5 flex flex-wrap border-l-10 even:bg-white/5">';

						// Name.
						echo '<h2 class="mb-1 px-2 text-3xl">' . esc_html( get_the_title( $doc ) ) . '</h4>';

						echo '<div class="w-full my-3 border-t border-white/10" aria-hidden="true"></div>';

						// Description / Instructions.
						echo '<div class="w-2/3 px-2 flex-shrink-0">';
						echo '<label class="mb-1 block text-sm font-bold">Description / Instructions</label>';
						echo wp_kses_post( get_field( 'description', $doc ) );
						echo '</div>';

						// Files.
						$files = get_field( 'files', $doc );
						if ( $files && count( $files ) ) {
							echo '<div class="w-1/3 flex-shrink-0">';
							echo '<label class="mb-1 px-2 block text-sm font-bold">Files</label>';
							foreach ( $files as $file_row ) {
								$file = sc_acf_subfield( $file_row, 'file' );
								if ( ! $file ) {
									continue;
								}
								$filename  = $file['filename'];
								$file_url  = $file['url'];
								$file_icon = $file['icon'];
								$filesize  = size_format( $file['filesize'] );
								echo '<a class="mb-1 last:mb-0 px-2 py-1 flex items-start text-sm hover:bg-light hover:text-dark transition-colors duration-500" href="' . esc_url( $file_url ) . '" target="_blank" rel="nofollow" title="Open &quot;' . esc_attr( $filename ) . '&quot;">';
								echo '<img class="mr-3" src="' . esc_url( $file_icon ) . '" width="36" alt>';
								echo '<div clas="flex-shrink-0">';
								echo '<p class="font-bold">' . esc_html( $filename ) . '</p>';
								echo '<p class="text-xs">' . esc_html( $filesize ) . '</p>';
								echo '</div>';
								echo '</a>';
							}
							echo '</div>';
						}
						echo '</li>';
					}
					echo '</ul>';
				}
				?>

			</article>


		<?php endwhile; ?>

	<?php endif; ?>

</div>

<?php
get_footer();
