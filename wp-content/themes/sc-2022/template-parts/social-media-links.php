<?php
/**
 * Social Media Links Loop
 *
 * @package sanday
 * @since 0.0.0
 */

$sm_links   = get_field( 'social_media_links', 'contact-info' ) ?? array();
$sm_classes = array(
	'facebook'  => 'fa-brands fa-facebook-f',
	'twitter'   => 'fa-brands fa-twitter',
	'instagram' => 'fa-brands fa-instagram',
	'youtube'   => 'fa-brands fa-youtube',
	'other'     => 'fa fa-external-link',
);

if ( count( $sm_links ) ) {
	echo '<ul class="mb-2 lg:mb-0 last:mb-0 lg:mr-4 lg:last:mr-0 flex items-center">';
	foreach ( $sm_links as $sm_link ) {
		$sm_type    = sc_acf_subfield( $sm_link, 'type' );
		$url        = sc_acf_subfield( $sm_link, 'url' );
		$label      = sc_acf_subfield( $sm_link, 'label' );
		$icon_class = $sm_classes[ $sm_type ];
		echo '<li class="mr-2.5 last:mr-0">';
		echo '<a class="w-9 h-9 p-2 block lg:hover:bg-white focus:bg-white lg:hover:text-black focus:text-black text-lg leading-none text-center transition-colors duration-500 ' . esc_attr( $icon_class ) . '" href="' . esc_url( $url ) . '" target="_blank" title="' . esc_attr( $label ) . '" rel="nofollow"></a>';
		echo '</li>';
	}
	echo '</ul>';
}
