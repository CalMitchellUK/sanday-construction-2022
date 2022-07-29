<?php
/**
 * Documents loop for Uesr Dashboard
 *
 * @package sanday
 * @since 0.0.0
 */

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

// Actionable alert.
if ( count( $actionables ) ) {
	echo '<div class="mb-10 px-4 py-5 border-4 border-amber-600 rounded-lg bg-amber-50 text-dark overflow-hidden">';
	echo '<h2 class="mb-6 text-2xl xl:text-3xl">The following documents require your attention</h2>';
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
		echo '<h2 class="mb-6 text-2xl lg:text-4xl">' . esc_html( $cat_title ) . '</h2>';

		// Items.
		echo '<ul class="">';

		// Loop.
		sc_build_file_rows( $items, true );

		echo '</ul>';

		echo '</li>';
	}

	echo '</ul>';

} else {

	echo '<p>You have no documents assigned to your account. If you believe this is an error, please get in touch.</p>';

}
