<?php
/**
 * Banner
 *
 * @package sanday
 * @since 0.0.0
 */

$banner_image = get_field( 'banner_image' );
if ( $banner_image ) {
	$height_classes = '';
	switch ( get_field( 'banner_size' ) ) {
		case 'large':
			$height_classes = 'max-h-25vh md:max-h-50vh';
			break;
		default:
			$height_classes = 'max-h-15vh md:max-h-30vh';
			break;
	}
	$banner_classes = 'relative w-full ' . $height_classes . ' overflow-hidden';

	echo '<div id="page-banner-image" class="' . esc_attr( $banner_classes ) . '">';
	echo '<div class="relative w-full pb-video"></div>';
	echo wp_get_attachment_image( $banner_image, 'banner-image', null, array( 'class' => 'absolute left-0 top-0 w-full h-full object-cover' ) );
	echo '</div>';
} else {
	echo '<div id="site-header-buffer" class="relative w-full hidden md:block"></div>';
}
