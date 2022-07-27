<?php
/**
 * Main Calls to action Loop
 *
 * @package sanday
 * @since 0.0.0
 */

function sc_build_columns( $col ) {
	$col_width    = $col['column_width'] ? $col['column_width'] : '1/1';
	$which_layout = $col['acf_fc_layout'];
	if ( $which_layout ) {

		echo '<div class="col w-full lg:w-' . esc_attr( $col_width ) . ' mb-6 lg:mb-0 last:mb-0 px-2.5 xl:px-5">';
		/* echo '<pre style="max-height: 400px;">' . var_export( $col, true ) . '</pre>'; */
		switch ( $which_layout ) {
			case 'text_block':
				sc_build_column__text( $col );
				break;
			case 'gallery_block':
				sc_build_column__gallery( $col );
				break;
			case 'image_block':
				sc_build_column__image( $col );
				break;
		}
		echo '</div>';
	}
}

function sc_build_column__text( $col ) {
	$alignment      = sc_acf_subfield( $col, 'text_alignment' );
	$is_ca          = 'center' === $alignment;
	$is_ra          = 'right' === $alignment;
	$flex_alignment = $is_ca ? 'items-center' : ( $is_ra ? 'items-center lg:items-end' : 'items-start' );
	$text_alignment = $is_ca ? 'text-center' : ( $is_ra ? 'text-center lg:text-right' : '' );
	$align_classes  = $flex_alignment . ' ' . $text_alignment;
	$has_btn        = sc_acf_subfield( $col, 'has_button' );
	$btn_html       = $has_btn ? sc_get_cta_options( sc_acf_subfield( $col, 'button' ) ) : '';
	echo '<div class="flex flex-col justify-center ' . esc_attr( $align_classes ) . '">';
	echo '<div class="tinymce mb-4 xl:mb-6 last:mb-0">' . wp_kses_post( sc_acf_subfield( $col, 'body' ) ) . '</div>';
	echo wp_kses_post( $btn_html );
	echo '</div>';
}

function sc_build_column__gallery( $col ) {
	// Unique ID is needed for slick.
	$show_captions = sc_acf_subfield( $col, 'show_captions' );
	$images        = sc_acf_subfield( $col, 'images' );
	$image_count   = count( $images );
	if ( empty( $image_count ) ) {
		return;
	}
	echo '<div class="slick-gallery">';
	$image_index = 0;
	foreach ( $images as $image ) {
		$caption_text  = ( $image_index + 1 ) . '/' . $image_count;
		$image_caption = $show_captions ? wp_get_attachment_caption( $image ) : '';
		if ( $image_caption ) {
			$caption_text .= ' - ' . $image_caption;
		}
		echo '<figure class="">';
		echo wp_get_attachment_image( $image, 'card', null, array( 'class' => '' ) );
		echo '<figcaption class="py-2 flex justify-center items-center text-center">' . esc_html( $caption_text ) . '</figcaption>';
		echo '</figure>';
		$image_index++;
	}
	echo '</div>';
}

function sc_build_column__image( $col ) {
	$show_caption = sc_acf_subfield( $col, 'show_caption' );
	$image_sizes  = sc_acf_subfield( $col, 'image_sizes' );
	$image        = sc_acf_subfield( $col, 'image' );
	echo '<figure class="flex flex-col">';
	echo wp_get_attachment_image( $image, $image_sizes, null, array( 'class' => '' ) );
	if ( $show_caption ) {
		echo '<figcaption class="py-2">' . esc_html( wp_get_attachment_caption( $image ) ) . '</figcaption>';
	}
	echo '</figure>';
}

// Builder.
$rows = get_field( 'rows' );
if ( have_rows( 'rows' ) ) {
	/* lg:w-1/1 lg:w-1/3 lg:w-1/2 lg:w-2/3 */
	echo '<div class="container relative mb-10 xl:mb-16 flex flex-col">';
	while ( have_rows( 'rows' ) ) {
		the_row();
		echo '<div class="row w-full mb-8 xl:mb-10 last:mb-0 flex flex-wrap">';
		array_walk( get_sub_field( 'cols' ), 'sc_build_columns' );
		echo '</div>';
	}
	echo '</div>';
}
