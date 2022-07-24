<?php
/**
 * Template Name: Contractor Dashboard
 *
 * @package sanday
 * @since 0.0.0
 */

// Vars.
$sc_id      = 'post-' . get_the_ID();
$sc_classes = implode( ' ', get_post_class() );
$logged_in  = is_user_logged_in();

get_header();

echo '<div class="container px-2.5 py-12 xl:px-5">';

echo '<article id="' . esc_attr( $sc_id ) . '" class="' . esc_attr( $sc_classes ) . '">';

echo '<header class="entry-header mb-10">';
the_title( '<h1 class="entry-title text-2xl lg:text-5xl leading-tight">', '</h1>' );
echo '</header>';

if ( $logged_in ) {
	// The content.
	echo '<div class="entry-content xl:w-10/12 mb-14">';
	the_content();
	echo '</div>';

	// Documents.
	get_template_part( 'template-parts/user-documents' );

} else {
	// The content.
	echo '<div class="entry-content">';
	echo '<p>You are not logged in. <a class="underline" href="' . esc_url( wp_login_url() ) . '" rel="nofollow" title="Go to login page">You can log in here</a></p>';
	echo '</div>';
}


echo '</article>';

echo '</div>';

get_footer();
