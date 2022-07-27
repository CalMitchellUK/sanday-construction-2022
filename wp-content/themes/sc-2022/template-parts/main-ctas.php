<?php
/**
 * Main Calls to action Loop
 *
 * @package sanday
 * @since 0.0.0
 */

$main_ctas = get_field( 'main_ctas', 'contact-info' ) ?? array();
if ( count( $main_ctas ) ) {
	echo '<ul class="lg:m-2 flex items-center">';
	foreach ( $main_ctas as $cta ) {
		$cta_html = sc_get_cta_options( $cta );
		echo '<li class="mr-2.5 last:mr-0">' . wp_kses_post( $cta_html ) . '</li>';
	}
	echo '</ul>';
}
