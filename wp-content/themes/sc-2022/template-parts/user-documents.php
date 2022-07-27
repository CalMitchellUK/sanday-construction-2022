<?php
/**
 * Documents loop for Uesr Dashboard
 *
 * @package sanday
 * @since 0.0.0
 */

// Vars.
$border_colors = array(
	'to-do'      => 'border-l-sky-600',
	'processing' => 'border-l-amber-500',
	'up-to-date' => 'border-l-green-600',
	'expired'    => 'border-l-red-600',
);
$bg_colors     = array(
	'to-do'      => 'bg-sky-600',
	'processing' => 'bg-amber-500',
	'up-to-date' => 'bg-green-600',
	'expired'    => 'bg-red-600',
);

// Categories.
$categories = array(
	'contracts'        => array(
		'name'  => 'Contracts',
		'items' => array(),
	),
	'company_policies' => array(
		'name'  => 'Company Policies',
		'items' => array(),
	),
	'licences'         => array(
		'name'  => 'Licences',
		'items' => array(),
	),
	'others'           => array(
		'name'  => 'Other Documents',
		'items' => array(),
	),

);

// Needs action.
$actionable_statuses = array( 'to-do', 'expired' );
$actionables         = array();

// Loop category keys.
$user_id = get_current_user_id();
if ( have_rows( 'docs', 'user_' . $user_id ) ) {
	$i1 = 1;
	foreach ( get_field( 'docs', 'user_' . $user_id ) as $item ) {
		// Item.
		$doc_title   = get_document_row_field( $item, 'title' );
		$doc_type    = get_document_row_field( $item, 'document_type' ) ?? 'others';
		$description = get_document_row_field( $item, 'description' );
		$file        = get_document_row_field( $item, 'file' );
		$files       = get_document_row_field( $item, 'files' );
		$doc_status  = get_document_row_field( $item, 'status' );
		$notes       = get_document_row_field( $item, 'notes' );
		$due_date    = get_document_row_field( $item, 'due_date' );
		$expiry_date = get_document_row_field( $item, 'expiry_date' );
		$item        = array(
			'id'          => $i1,
			'doc_type'    => $doc_type,
			'doc_title'   => $doc_title,
			'description' => $description,
			'file'        => $file,
			'files'       => $files,
			'doc_status'  => $doc_status,
			'notes'       => $notes,
			'due_date'    => $due_date,
			'expiry_date' => $expiry_date,
		);

		// Add to category list.
		array_push( $categories[ $doc_type ]['items'], $item );

		// Actionable check.
		if ( $doc_status && in_array( $doc_status['value'], $actionable_statuses, true ) ) {
			array_push( $actionables, $item );
		}

		// Increment ID.
		$i1++;
	}
}

echo '<h2 class="mb-6 text-xl lg:text-4xl">Your Documents</h2>';

// Actionable alert.
if ( count( $actionables ) ) {
	echo '<div class="mb-10 px-4 py-5 border-4 border-amber-600 rounded-lg bg-amber-50 text-dark overflow-hidden">';
	echo '<h3 class="mb-4">The following documents require your attention:</h3>';
	echo '<ul class="pl-6 block list-disc">';
	foreach ( $actionables as $item ) {
		$cat_title = $categories[ $item['doc_type'] ]['name'] ?? '';
		echo '<li class="w-full mb-2 last:mb-0">';
		echo '<a class="underline" href="#doc-' . esc_attr( $item['id'] ) . '" title="Go to &quot;' . esc_attr( $item['doc_title'] ) . '&quot;">';
		if ( $cat_title ) {
			echo '<strong>(' . esc_html( $cat_title ) . ')</strong> - ';
		}
		echo esc_html( $item['doc_title'] );
		echo '</a>';
		echo '</li>';
	}
	echo '</ul>';
	echo '</div>';
}

// Full list.
$items_count = 0;
foreach ( $categories as $slug => $category ) {
	$items_count = $items_count + count( $category['items'] );
}
if ( $items_count ) {
	echo '<ul class="block xl:w-10/12">';

	foreach ( $categories as $slug => $category ) {
		$cat_title = $category['name'];
		$items     = $category['items'];

		// Skip empty categories.
		if ( ! count( $items ) ) {
			continue;
		}

		// Start.
		echo '<li class="mb-12 block">';

		// Toggle.
		echo '<h3 class="mb-6 text-2xl">' . esc_html( $cat_title ) . '</h3>';

		// Items.
		echo '<ul class="">';
		// Loop.
		foreach ( $items as $item ) {
			$status_color = $item['doc_status'] && $border_colors[ $item['doc_status']['value'] ] ? $border_colors[ $item['doc_status']['value'] ] : 'border-l-gray-700';

			echo '<li id="doc-' . esc_attr( $item['id'] ) . '" class="w-full mb-3 last:mb-0 px-4 py-5 flex flex-wrap border-l-10 ' . esc_attr( $status_color ) . ' even:bg-white/5">';

			// Name.
			echo '<h4 class="mb-1 px-2 text-2xl">' . esc_html( $item['doc_title'] ) . '</h4>';

			echo '<div class="w-full my-3 border-t border-white/10" aria-hidden="true"></div>';

			// Description / Instructions.
			echo '<div class="w-2/3 px-2 flex-shrink-0">';
			echo '<label class="mb-1 block text-sm font-bold">Description / Instructions</label>';
			echo wp_kses_post( $item['description'] );
			echo '</div>';

			// Files.
			$files = sc_acf_subfield( $item, 'files' );
			if ( $files && count( $files ) ) {
				echo '<div class="w-1/3 flex-shrink-0">';
				echo '<label class="mb-1 px-2 block text-sm font-bold">Files</label>';
				foreach ( $files as $file_row ) {
					$file = sc_acf_subfield( $file_row, 'file' );
					if ( ! $file ) {
						continue;
					}
					$filename  = $file['filename'];
					$file_url  = $file['url'];
					$file_icon = $file['icon'];
					$filesize  = size_format( $file['filesize'] );
					echo '<a class="mb-1 last:mb-0 px-2 py-1 flex items-start text-sm hover:bg-light hover:text-dark transition-colors duration-500" href="' . esc_url( $file_url ) . '" target="_blank" rel="nofollow" title="Open &quot;' . esc_attr( $filename ) . '&quot;">';
					echo '<img class="mr-3" src="' . esc_url( $file_icon ) . '" width="36" alt>';
					echo '<div clas="flex-shrink-0">';
					echo '<p class="font-bold">' . esc_html( $filename ) . '</p>';
					echo '<p class="text-xs">' . esc_html( $filesize ) . '</p>';
					echo '</div>';
					echo '</a>';
				}
				echo '</div>';
			}

			// Notes.
			if ( $item['notes'] ) {
				echo '<div class="w-full my-3 border-t border-white/10" aria-hidden="true"></div>';
				echo '<div class="w-full px-2 flex-shrink-0">';
				echo '<label class="mb-1 block text-sm font-bold">Notes</label>';
				echo wp_kses_post( $item['notes'] );
				echo '</div>';
			}

			if ( $item['doc_status'] || $item['due_date'] || $item['expiry_date'] ) {
				echo '<div class="w-full my-3 border-t border-white/10" aria-hidden="true"></div>';
			}

			// Status.
			if ( $item['doc_status'] ) {
				$blip_color = $bg_colors[ $item['doc_status']['value'] ] ? $bg_colors[ $item['doc_status']['value'] ] : 'border-l-gray-700';

				echo '<div class="w-1/3 px-2 flex-shrink-0">';
				echo '<label class="mb-1 block text-sm font-bold">Status</label>';
				echo '<p class="flex items-center">';
				echo '<span class="w-3 h-3 mr-2 inline-flex rounded-full ' . esc_attr( $blip_color ) . '"></span>';
				echo '<span class="text-lg leading-none">' . esc_html( $item['doc_status']['label'] ) . '</span>';
				echo '</p>';
				echo '</div>';
			}

			// Due Date.
			if ( $item['due_date'] ) {
				echo '<div class="w-1/3 px-2 flex-shrink-0">';
				echo '<label class="mb-1 block text-sm font-bold">Due Date</label>';
				echo '<p>' . esc_html( sc_get_date( $item['due_date'] ) ) . '</p>';
				echo '</div>';
			}

			// Expiry Date.
			if ( $item['expiry_date'] ) {
				echo '<div class="w-1/3 px-2 flex-shrink-0">';
				echo '<label class="mb-1 block text-sm font-bold">Expiry date</label>';
				echo '<p>' . esc_html( sc_get_date( $item['expiry_date'] ) ) . '</p>';
				echo '</div>';
			}

			echo '</li>';
		}
		echo '</ul>';

		echo '</li>';
	}

	echo '</ul>';

} else {

	echo '<p>You have no documents assigned to your account. If you believe this is an error, please get in touch.</p>';

}
