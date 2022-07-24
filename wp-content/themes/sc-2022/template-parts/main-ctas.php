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
		$cta_type   = sc_acf_subfield( $cta, 'type' );
		$url        = sc_acf_subfield( $cta, 'url' );
		$target     = '_blank';
		$icon_class = 'fa fa-external-link';
		if ( 'internal' === $cta_type ) {
			$url        = sc_acf_subfield( $cta, 'page' );
			$icon_class = 'fa fa-chevron-right';
			$target     = '';
		}
		$cta_html = get_sc_cta(
			array(
				'href'   => $url,
				'text'   => sc_acf_subfield( $cta, 'text' ),
				'title'  => sc_acf_subfield( $cta, 'label' ),
				'target' => $target,
				'icon'   => $icon_class,
			)
		);
		echo '<li class="mr-2.5 last:mr-0">';
			echo wp_kses_post( $cta_html );
		echo '</li>';
	}
	echo '</ul>';
}


