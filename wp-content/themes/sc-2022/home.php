<?php
/**
 * Template Name: Home
 * Description: The default template for the homepage.
 *
 * @package sanday
 * @since 0.0.0
 */

get_header();

$main_text = get_field( 'main_text' );

// Main Text.
echo '<div class="container relative mb-16 xl:mb-20 px-2.5 xl:px-5">';
echo '<div class="half-height-offset w-full xl:w-3/4">';
echo '<div class="bg-light text-dark p-8 drop-shadow">';
echo '<h1 class="text-3xl xl:text-5xl xl:leading-tight 2xl:text-6xl 2xl:leading-tight">' . esc_html( $main_text ) . '</h1>';
echo '</div>';
echo '</div>';
echo '</div>';

// Key Information.
$ki_arr   = get_field( 'key_info' ) ?? array();
$ki_count = count( $ki_arr );
if ( $ki_count ) {
	$col_width = 3 === $ki_count ? 'lg:w-1/3' : ( 2 === $ki_count ? 'lg:w-1/2' : '' );
	echo '<div class="container relative mb-10 xl:mb-16">';
	echo '<div class="mb-10 lg:flex flex-wrap">';
	foreach ( $ki_arr as $ki_col ) {
		$image      = sc_acf_subfield( $ki_col, 'image' ) ?? array();
		$card_title = sc_acf_subfield( $ki_col, 'title' ) ?? '';
		$card_text  = sc_acf_subfield( $ki_col, 'text' ) ?? '';
		echo '<div class="w-full ' . esc_attr( $col_width ) . ' mb-5 px-2.5 xl:px-5 flex flex-col">';
		echo '<div class="grow flex flex-col bg-light text-dark">';
		echo wp_get_attachment_image( $image, 'card', null, array( 'class' => 'block' ) );
		echo '<div class="p-2.5 xl:p-5 flex flex-col grow">';
		echo '<h2 class="mb-3 text-lg xl:text-2xl">' . esc_html( $card_title ) . '</h2>';
		echo '<p class="">' . wp_kses_post( $card_text ) . '</p>';
		echo '</div>';
		echo '</div>';
		echo '</div>';
	}
	echo '</div>';
	echo '</div>';
}

// Builder.
get_template_part( 'template-parts/builder' );

get_footer();
