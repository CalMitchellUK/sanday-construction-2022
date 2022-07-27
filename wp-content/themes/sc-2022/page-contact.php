<?php
/**
 * Template Name: Contact Us
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

				<div class="w-full my-10 border-t border-white/10" aria-hidden="true"></div>

				<div class="flex flex-wrap items-start">
					<div class="w-full lg:w-1/2 lg:pr-5">
						<?php echo do_shortcode( '[contact-form-7 id="205" title="Contact Form"]' ); ?>
					</div>

					<div class="w-full lg:w-1/2 lg:pl-5">
						<?php
						$ci_heading = get_field( 'heading', 'contact-info' );
						if ( $ci_heading ) {
							echo '<h2 class="text-4xl leading-tight">' . esc_html( $ci_heading ) . '</h2>';
						}

						$ci_address = get_field( 'address', 'contact-info' );
						if ( $ci_address ) {
							echo '<div class="my-3 border-t border-white/10" aria-hidden="true"></div>';
							echo '<div class="">';
							echo '<label class="mb-1 block text-sm font-bold">Address</label>';
							echo '<address>' . wp_kses_post( $ci_address ) . '</address>';
							echo '</div>';
						}

						$contact_details = get_field( 'contact_details', 'contact-info' ) ?? array();
						if ( count( $contact_details ) ) {

							foreach ( $contact_details as $contact ) {
								$c_name     = sc_acf_subfield( $contact, 'name' );
								$c_email    = sc_acf_subfield( $contact, 'email' );
								$c_tel      = sc_acf_subfield( $contact, 'tel' );
								$c_display  = sc_acf_subfield( $contact, 'display' );
								$phone_text = empty( $c_display ) ? $c_tel : $c_display;

								if ( ! ( $c_email && $phone_text ) ) {
									continue;
								}

								echo '<div class="w-full my-3 border-t border-white/10" aria-hidden="true"></div>';

								echo '<h3 class="w-full mb-3 text-xl">' . esc_html( $c_name ) . '</h3>';
								echo '<div class="flex flex-wrap">';
								// Email.
								if ( $c_email ) {
									echo '<div class="w-full lg:w-1/2 flex-shrink-0">';
									echo '<label class="mb-1 block text-sm font-bold">Email</label>';
									echo '<p><a class="underline lg:hover:no-underline focus:no-underline" href="mailto:' . esc_attr( $c_email ) . '" rel="nofollow" target="_blank" title="Email: ' . esc_attr( $c_email ) . '">' . esc_html( $c_email ) . '</a></p>';
									echo '</div>';
								}
								// Phone.
								if ( $phone_text ) {
									echo '<div class="w-full lg:w-1/2 flex-shrink-0">';
									echo '<label class="mb-1 block text-sm font-bold">Phone</label>';
									echo '<p><a class="underline lg:hover:no-underline focus:no-underline" href="tel:' . esc_attr( $c_tel ) . '" rel="nofollow" target="_blank" title="Call: ' . esc_attr( $phone_text ) . '">' . esc_html( $phone_text ) . '</a></p>';
									echo '</div>';
								}
								echo '</div>';
							}
						}
						?>
					</div>
				</div>

			</article>


		<?php endwhile; ?>

	<?php endif; ?>

</div>

<?php
get_footer();
