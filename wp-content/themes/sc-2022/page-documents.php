<?php
/**
 * Template Name: Your Documents
 *
 * @package sanday
 * @since 0.0.0
 */

// Vars.
$sc_id      = 'post-' . get_the_ID();
$sc_classes = implode( ' ', get_post_class() );
$logged_in  = is_user_logged_in();

get_header();

echo '<div class="container mb-10 xl:mb-16 px-2.5 xl:px-5 pt-8 xl:pt-12">';

echo '<article id="' . esc_attr( $sc_id ) . '" class="' . esc_attr( $sc_classes ) . '">';

echo '<header class="entry-header mb-10">';
the_title( '<h1 class="entry-title text-3xl xl:text-5xl">', '</h1>' );
echo '</header>';

if ( $logged_in ) {
	// The content.
	echo '<div class="entry-content tinymce xl:w-10/12 mb-10 xl:mb-12">';
	the_content();
	echo '</div>';

	// Documents.
	get_template_part( 'template-parts/user-documents' );

} else {
	// The content.
	echo '<div class="entry-content tinymce">';
	echo '<p>You are not logged in. <a class="underline" href="' . esc_url( wp_login_url() ) . '" rel="nofollow" title="Go to login page">You can log in here</a></p>';
	echo '</div>';
}


echo '</article>';

echo '</div>';

get_footer();
