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
echo '<div class="container relative px-2.5 xl:px-5">';
echo '<div class="half-height-offset w-full xl:w-3/4 mb-10">';
echo '<div class="bg-light text-dark p-8 drop-shadow">';
echo '<h1 class="text-3xl xl:text-5xl 2xl:text-6xl">' . esc_html( $main_text ) . '</h1>';
echo '</div>';
echo '</div>';
echo '</div>';

// Key Information.
$ki_arr  = get_field( 'key_information' ) ?? array();
$ki_col1 = $ki_arr['column_1'] ?? array();
$ki_col2 = $ki_arr['column_2'] ?? array();
$ki_col3 = $ki_arr['column_3'] ?? array();
$ki_cols = array( $ki_col1, $ki_col2, $ki_col3 );
echo '<div class="container relative px-0 py-8 xl:py-10">';
echo '<div class="mb-10 md:flex">';
foreach ( $ki_cols as $ki_col ) {
	// Image.
	$img     = isset( $ki_col['image'] ) ? $ki_col['image'] : array();
	$img_src = isset( $img['sizes'] ) ? $img['sizes']['card'] : '';
	$img_alt = isset( $img['alt'] ) ? $img['alt'] : '';
	// Text.
	$card_title = isset( $ki_col['title'] ) ? $ki_col['title'] : '';
	$card_text  = isset( $ki_col['text'] ) ? $ki_col['text'] : '';
	echo '<div class="w-full md:w-1/3 px-2.5 xl:px-5 flex flex-col">';
	echo '<div class="grow flex flex-col bg-light text-dark">';
	echo '<img class="block" src="' . esc_url( $img_src ) . '" width="1280" height="720" alt="' . esc_attr( $img_alt ) . '">';
	echo '<div class="p-2.5 xl:p-5 flex flex-col grow">';
	echo '<h2 class="mb-3 text-lg xl:text-2xl">' . esc_html( $card_title ) . '</h2>';
	echo '<p class="">' . wp_kses_post( $card_text ) . '</p>';
	echo '</div>';
	echo '</div>';
	echo '</div>';
}
echo '</div>';
echo '</div>';

get_footer();
