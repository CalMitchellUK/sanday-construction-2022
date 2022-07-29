<?php
/**
 * The main functionality of the theme.
 *
 * @package sanday
 * @since 0.0.0
 */

/**
 * Adds the Document post-type
 */
function add_document_post_type() {
	$args = array(
		'label'               => 'Document',
		'labels'              => array(
			'name'                  => 'Documents',
			'singular_name'         => 'Document',
			'menu_name'             => 'Documents',
			'name_admin_bar'        => 'Document',
			'archives'              => 'Document Archives',
			'attributes'            => 'Document Attributes',
			'parent_item_colon'     => 'Parent Document',
			'all_items'             => 'All Documents',
			'add_new_item'          => 'Add New Document',
			'add_new'               => 'Add Document',
			'new_item'              => 'New Document',
			'edit_item'             => 'Edit Document',
			'update_item'           => 'Update Document',
			'view_item'             => 'View Document',
			'view_items'            => 'View Documents',
			'search_items'          => 'Search document post',
			'not_found'             => 'Not found',
			'not_found_in_trash'    => 'Not found in bin',
			'featured_image'        => 'Thumbnail',
			'set_featured_image'    => 'Set thumbnail',
			'remove_featured_image' => 'Remove thumbnail',
			'use_featured_image'    => 'Use as thumbnail',
			'insert_into_item'      => 'Insert into document post',
			'uploaded_to_this_item' => 'Uploaded to this document post',
			'items_list'            => 'Documents list',
			'items_list_navigation' => 'Documents list navigation',
			'filter_items_list'     => 'Filter documents list',
		),
		'supports'            => array( 'title' ),
		'hierarchical'        => false,
		'public'              => false,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_position'       => 20,
		'menu_icon'           => 'dashicons-media-document',
		'show_in_admin_bar'   => true,
		'show_in_nav_menus'   => true,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => true,
		'publicly_queryable'  => false,
		'capability_type'     => 'page',
	);
	register_post_type( 'document', $args );
}
add_action( 'init', 'add_document_post_type', 0 );

/**
 * Removes the default user roles that WP uses, added new ones from User Role Editor.
 */
function sc_remove_unused_roles() {
	remove_role( 'author' );
	remove_role( 'editor' );
	remove_role( 'contributor' );
	remove_role( 'subscriber' );
}
add_action( 'init', 'sc_remove_unused_roles' );

add_filter( 'wp_is_application_passwords_available', '__return_false' );

/**
 * Theme setup.
 */
function tailpress_setup() {
	add_theme_support( 'title-tag' );

	register_nav_menus(
		array(
			'nav'     => __( 'Site navigation', 'tailpress' ),
			'sitemap' => __( 'Sitemap', 'tailpress' ),
			'useful'  => __( 'Useful links', 'tailpress' ),
		)
	);

	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		)
	);

	add_theme_support( 'custom-logo' );
	add_theme_support( 'post-thumbnails' );

	add_theme_support( 'align-wide' );
	add_theme_support( 'wp-block-styles' );

	add_theme_support( 'editor-styles' );
	add_editor_style( 'css/editor-style.css' );
}

add_action( 'after_setup_theme', 'tailpress_setup' );

/**
 * Enqueue theme assets.
 */
function tailpress_enqueue_assets() {
	$theme = wp_get_theme();
	// Google fonts.
	wp_enqueue_style( 'google-fonts', 'https://fonts.googleapis.com/css2?family=Kadwa&family=Roboto:wght@400;500;700&display=swap', array(), $theme->get( 'Version' ) );

	// Tailpress.
	wp_enqueue_style( 'theme', tailpress_asset( 'css/app.css' ), array( 'slick' ), $theme->get( 'Version' ) );
	wp_enqueue_script( 'tailpress', tailpress_asset( 'js/app.js' ), array( 'jquery', 'slick' ), $theme->get( 'Version' ), true );

	// Font Awsome.
	wp_enqueue_style( 'fontawesome', get_stylesheet_directory_uri() . '/css/fontawesome/css/all.min.css', array(), '6.1.1' );

	// Slick.
	wp_enqueue_style( 'slick', '//cdn.jsdelivr.net/npm/@accessible360/accessible-slick@1.0.1/slick/slick.min.css', array(), '1.0.1' );
	wp_enqueue_style( 'accessible-slick-theme', '//cdn.jsdelivr.net/npm/@accessible360/accessible-slick@1.0.1/slick/accessible-slick-theme.min.css', array(), '1.0.1' );
	wp_enqueue_script( 'slick', '//cdn.jsdelivr.net/npm/@accessible360/accessible-slick@1.0.1/slick/slick.min.js', array( 'jquery' ), $theme->get( 'Version' ), true );
}
add_action( 'wp_enqueue_scripts', 'tailpress_enqueue_assets' );

/**
 * Enqueue admin assets.
 */
function enqueue_admin_assets() {
	$theme = wp_get_theme();
	wp_enqueue_style( 'theme', tailpress_asset( 'css/admin.css' ), array(), $theme->get( 'Version' ) );
	wp_enqueue_script( 'admin', tailpress_asset( 'js/admin.js' ), array(), $theme->get( 'Version' ), true );
}
add_action( 'admin_enqueue_scripts', 'enqueue_admin_assets' );

/**
 * Get asset path.
 *
 * @param string $path Path to asset.
 * @return string
 */
function tailpress_asset( $path ) {
	if ( wp_get_environment_type() === 'production' ) {
		return get_stylesheet_directory_uri() . '/' . str_replace( array( '.css', '.js' ), array( '.min.css', '.min.js' ), $path );
	}

	return add_query_arg( 'time', time(), get_stylesheet_directory_uri() . '/' . $path );
}

/**
 * Add custom ACF options pages.
 */
function sc_add_custom_options_pages() {
	acf_add_options_page(
		array(
			'menu_slug'  => 'contact-info',
			'page_title' => __( 'Contact Info' ),
			'post_id'    => 'contact-info',
			'capability' => 'edit_posts',
			'icon_url'   => 'dashicons-phone',
			'position'   => 80,
		)
	);
}
add_action( 'acf/init', 'sc_add_custom_options_pages' );

/**
 * Adds option 'li_class' to 'wp_nav_menu'.
 *
 * @param string  $classes String of classes.
 * @param mixed   $item The curren item.
 * @param WP_Term $args Holds the nav menu arguments.
 * @param string  $depth Depth of li.
 *
 * @return array
 */
function tailpress_nav_menu_add_li_class( $classes, $item, $args, $depth ) {
	if ( isset( $args->li_class ) ) {
		$classes[] = $args->li_class;
	}

	if ( isset( $args->{"li_class_$depth"} ) ) {
		$classes[] = $args->{"li_class_$depth"};
	}

	return $classes;
}

add_filter( 'nav_menu_css_class', 'tailpress_nav_menu_add_li_class', 10, 4 );

/**
 * Adds option 'submenu_class' to 'wp_nav_menu'.
 *
 * @param string  $classes String of classes.
 * @param WP_Term $args Holds the nav menu arguments.
 * @param string  $depth Depth of li.
 *
 * @return array
 */
function tailpress_nav_menu_add_submenu_class( $classes, $args, $depth ) {
	if ( isset( $args->submenu_class ) ) {
		$classes[] = $args->submenu_class;
	}

	if ( isset( $args->{"submenu_class_$depth"} ) ) {
		$classes[] = $args->{"submenu_class_$depth"};
	}

	return $classes;
}

add_filter( 'nav_menu_submenu_css_class', 'tailpress_nav_menu_add_submenu_class', 10, 3 );

/**
 * Adds option 'anchor_class' to 'wp_nav_menu'.
 *
 * @param array   $attrs Element Attributes to be built.
 * @param WP_Term $item Holds the nav menu item arguments.
 * @param WP_Term $args Holds the nav menu arguments.
 *
 * @return array Updated $attrs.
 */
function cm_nav_menu_link_add_class( $attrs, $item, $args ) {
	$attrs['class'] = isset( $attrs['class'] ) ? $attrs['class'] : '';

	if ( isset( $args->anchor_class ) ) {
		$attrs['class'] .= ' ' . $args->anchor_class;
	}

	if ( in_array( 'current-menu-item', $item->classes, true ) ) {
		$attrs['class'] .= ' border-b-white';
	}

	return $attrs;
}
add_filter( 'nav_menu_link_attributes', 'cm_nav_menu_link_add_class', 1, 3 );

/**
 * ==============================================
 * Disable "Post" Post-type
 * ==============================================
 */
// Removes "Post" from admin sidebar.
add_action(
	'admin_menu',
	function() {
		remove_menu_page( 'edit.php' );
	}
);
// Removes "New post" from admin header.
add_action(
	'admin_bar_menu',
	function( $wp_admin_bar ) {
		$wp_admin_bar->remove_node( 'new-post' );
	},
	999
);
/**
 * Removes "New post" from admin header.
 */
function sc_remove_add_new_post_href_in_admin_bar() {
	?>
	<script type="text/javascript">
		document.addEventListener('DOMContentLoaded', function() {
			var $addNew = document.getElementById('wp-admin-bar-new-content');
			if (!$addNew) {
				return;
			}
			var $addNewA = $addNew.getElementsByTagName('a')[0];
			if ($addNewA) {
				$addNewA.setAttribute('href', '#!');
			}
		})
	</script>
	<?php
}
add_action( 'admin_footer', 'sc_remove_add_new_post_href_in_admin_bar' );
add_action(
	'init',
	function() {
		if ( is_user_logged_in() ) {
				add_action( 'wp_footer', 'sc_remove_add_new_post_href_in_admin_bar' );
		}
	}
);
// Removes Dashboard "Draft Post".
add_action(
	'wp_dashboard_setup',
	function() {
		remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
	},
	999
);

add_action(
	'init',
	function() {
		// Image sizes.
		remove_image_size( '1536x1536' );
		remove_image_size( '2048x2048' );
		add_image_size( 'banner-image', 1920, 1080, true );
		add_image_size( 'card', 1280, 720, true );
	}
);

/**
 * Get CTA data from Button Fields.
 *
 * @param Array $cta Array of CTA settings.
 * @return String HTML of the CTA button.
 */
function sc_get_cta_options( $cta = array() ) {
	$cta_type   = sc_acf_subfield( $cta, 'type' );
	$url        = sc_acf_subfield( $cta, 'url' );
	$target     = '_blank';
	$icon_class = 'fa fa-external-link';
	if ( 'internal' === $cta_type ) {
		$url        = sc_acf_subfield( $cta, 'page' );
		$icon_class = 'fa fa-chevron-right';
		$target     = '';
	}
	return sc_get_cta_html(
		array(
			'href'   => $url,
			'text'   => sc_acf_subfield( $cta, 'text' ),
			'title'  => sc_acf_subfield( $cta, 'label' ),
			'target' => $target,
			'icon'   => $icon_class,
		)
	);
}

/**
 * Build a consistent Call-to-action element
 *
 * @param Array $opts Contains all the options needed to build the CTA.
 * @return String Returns HTML.
 */
function sc_get_cta_html( $opts = array() ) {
	// Options.
	$href      = isset( $opts['href'] ) ? $opts['href'] : '';
	$tagname   = $href ? 'a' : 'button';
	$is_anchor = 'a' === $tagname;
	$text      = isset( $opts['text'] ) ? $opts['text'] : '';
	$label     = isset( $opts['title'] ) ? $opts['title'] : $text;
	$target    = isset( $opts['target'] ) ? $opts['target'] : '';
	$rel       = isset( $opts['rel'] ) ? $opts['rel'] : 'nofollow noreferrer';
	$icon      = isset( $opts['icon'] ) ? $opts['icon'] : '';
	$direction = isset( $opts['icon_position'] ) ? $opts['icon_position'] : 'right';
	// Text.
	$text_el = '<span>' . $text . '</span>';
	// Icon.
	$icon_classes = ( 'right' === $direction ? 'ml-2 ' : 'mr-2' ) . ' text-md ' . $icon;
	$icon_el      = $icon && $direction ? '<i class="' . $icon_classes . '"></i>' : '';
	// Parent.
	$classes = 'relative px-3.5 py-2.5 flex items-center border-2 border-light rounded-full bg-light lg:hover:bg-transparent focus:bg-transparent text-dark lg:hover:text-light focus:text-light text-lg font-bold leading-none transition-colors duration-500';
	if ( 'left' === $direction ) {
		$classes .= ' flex-row-reverse';
	}
	$attributes = array(
		'class'  => $classes,
		'href'   => $href,
		'target' => $is_anchor ? $target : '',
		'rel'    => $is_anchor ? $rel : '',
		'title'  => $label,
	);
	$attr_html  = '';
	foreach ( $attributes  as $key => $val ) {
		if ( empty( $val ) ) {
			continue;
		}
		$attr_html .= ' ' . $key . '="' . $val . '"';
	}
	return '<' . $tagname . $attr_html . '>' . $text_el . $icon_el . '</' . $tagname . '>';
}

/**
 * Get the Documents Dashboard page
 * Uses the page template to return the first page using the template.
 *
 * @return Mixed The Documents Dashboard page as Object or false as Boolean.
 */
function get_documents_page() {
	$dashboard_query = get_pages(
		array(
			'meta_key'   => '_wp_page_template',
			'meta_value' => 'page-documents.php',
			'number'     => 1,
		),
	);
	return count( $dashboard_query ) ? $dashboard_query[0] : false;
}

/**
 * Get the Employees/Contractors to the Documents Dashboard page.
 *
 * @param  String $redirect_to The redirect destination URL.
 * @param  String $request The requested redirect destination URL passed as a parameter.
 * @param  Mixed  $user (WP_User|WP_Error) WP_User object if login was successful, WP_Error object otherwise.
 * @return String The Documents Dashboard page, home URL, or redirect link.
 */
function sc_login_redirect( $redirect_to, $request, $user ) {
	if ( isset( $user->roles ) && is_array( $user->roles ) && ! user_can( $user, 'redirect_to_dashboard' ) ) {
		$page = get_documents_page();
		return isset( $page ) ? get_permalink( $page ) : false;
	} else {
		return $redirect_to;
	}
}
add_filter( 'login_redirect', 'sc_login_redirect', 10, 3 );


/**
 * Get a subfield from ACF with validation
 *
 * @param Array  $item A repeater row.
 * @param String $key  The field slug.
 * @return Mixed Can be anything.
 */
function sc_acf_subfield( $item = array(), $key = '' ) {
	return $key && isset( $item[ $key ] ) ? $item[ $key ] : false;
}

/**
 * Convert date into d/m/Y format
 *
 * @param String $date_string  The field slug.
 * @return Mixed Can be anything.
 */
function sc_get_date( $date_string = '' ) {
	if ( empty( $date_string ) ) {
		return '';
	}
	$string = strtotime( $date_string );
	return gmdate( 'd/m/Y', $string );
}

/**
 * Figure out if the document attachment is a Document post-type or just files and notes fields.
 *
 * @param Array  $item A repeater row.
 * @param String $key  The field slug.
 * @return Mixed Can be anything.
 */
function get_document_row_field( $item = array(), $key = '' ) {
	if ( ! $key ) {
		return false;
	}
	$is_existing = sc_acf_subfield( $item, 'select_exisiting' );
	$post_keys   = array( 'document_type', 'description', 'files', 'title' );
	$is_post_key = in_array( $key, $post_keys, true );
	$document    = $is_existing ? sc_acf_subfield( $item, 'document' ) : false;
	if ( $is_post_key && $document ) {
		// Not ACF.
		if ( 'title' === $key ) {
			return get_the_title( $document );
		}
		// ACF fields.
		return get_field( $key, $document );
	} else {
		return sc_acf_subfield( $item, $key );
	}
}

/**
 * Loop through users to check for expired.
 */
function cs_update_exired_docs() {
	// Only dashboard.
	global $pagenow;
	if ( 'index.php' !== $pagenow ) {
		return;
	}
	// Start.
	$today   = gmdate( 'Ymd' );
	$expired = array();
	$soon    = array();
	foreach ( get_users() as $user ) {
		$data    = $user->data;
		$user_id = $data->ID;
		if ( have_rows( 'docs', 'user_' . $user_id ) ) {
			while ( have_rows( 'docs', 'user_' . $user_id ) ) {
				the_row();
				$is_existing = get_sub_field( 'select_exisiting' );
				$document    = $is_existing ? get_sub_field( 'document' ) : false;
				$doc_title   = $document ? get_the_title( $document ) : get_sub_field( 'title' );
				$doc_status  = get_sub_field( 'status' );
				$expiry_date = get_sub_field( 'expiry_date' );
				if ( empty( $expiry_date ) ) {
					continue;
				}
				$exp_dt      = strtotime( $expiry_date );
				$exp_text    = gmdate( 'd/m/Y', $exp_dt );
				$notice_text = $data->display_name . ': ' . $doc_title . ' - <strong>' . $exp_text . '</strong>';
				if ( $today >= $expiry_date ) {
					array_push( $expired, $notice_text );
					// Update to expired, if not already.
					if ( 'expired' !== $doc_status['value'] ) {
						update_sub_field( 'status', 'expired' );
					}
				} else {
					$month_ahead = gmdate( 'Ymd', strtotime( '-1 months', strtotime( $expiry_date ) ) );
					if ( $today >= $month_ahead ) {
						array_push( $soon, $notice_text );
					}
				}
			}
		}
	}
	// Not Employees/Contractors.
	if ( ! current_user_can( 'edit_users' ) ) {
		return;
	}
	// Display notices.
	if ( count( $expired ) || count( $soon ) ) {
		add_action(
			'admin_notices',
			function() use ( $expired, $soon ) {
				if ( count( $expired ) ) {
					echo '<div id="docs-expired" class="notice notice-error">';
					echo '<p>The following documents <strong>have expired</strong>:</p>';
					echo '<ul>';
					foreach ( $expired as $notice ) {
						echo '<li>';
						echo wp_kses_post( $notice );
						echo '</li>';
					}
					echo '</ul>';
					echo '</div>';
				}
				if ( count( $soon ) ) {
					echo '<div id="docs-expiring" class="notice notice-info">';
					echo '<p>The following documents will expire within the next month:</p>';
					echo '<ul>';
					foreach ( $soon as $notice ) {
						echo '<li>';
						echo wp_kses_post( $notice );
						echo '</li>';
					}
					echo '</ul>';
					echo '</div>';
				}
			}
		);
	}
}
add_filter( 'init', 'cs_update_exired_docs' );

/**
 * Only show published posts in relationship fields.
 *
 * @param Array $args Array of query arguments.
 * @return Array Returns updated query arguments.
 */
function filter_acf_relationship( $args ) {
	$args['post_status'] = 'publish';
	return $args;
}
add_filter( 'acf/fields/relationship/query', 'filter_acf_relationship', 10, 3 );

/**
 * Build the columns for the Staff Overview Dashboard Widget.
 *
 * @param Boolean $foot Are you currently rendering the table head or foot.
 * @param Boolean $admin Can the current user edit other users.
 * @return String Returns the HTML of the columns.
 */
function sc_get_user_dashboard_cols( $foot = false, $admin = false ) {
	$row1  = '<th colspan="5">Documents</th>';
	$row2  = '<th class="keyed"><div><span class="blip bg-to-do"></span><span class="text">To-do</span></div></th>';
	$row2 .= '<th class="keyed"><div><span class="blip bg-processing"></span><span class="text">Processing</span></div></th>';
	$row2 .= '<th class="keyed"><div><span class="blip bg-up-to-date"></span><span class="text">Up-tp-date</span></div></th>';
	$row2 .= '<th class="keyed"><div><span class="blip bg-expired"></span><span class="text">Expired</span></div></th>';
	$row2 .= '<th class="keyed"><div><span class="blip bg-other"></span><span class="text">Other</span></div></th>';

	$html  = '<tr>';
	$html .= '<th rowspan="2">Display Name</th>';
	$html .= $admin ? '<th rowspan="2">Controls<br><small>(Admins only)</small></th>' : '';
	$html .= $foot ? $row2 : $row1;
	$html .= '</tr>';
	$html .= '<tr>';
	$html .= $foot ? $row1 : $row2;
	$html .= '</tr>';
	return $html;
}

/**
 * Override default dashboard content.
 */
function sc_dashboard_widgets() {
	global $wp_meta_boxes;
	unset( $wp_meta_boxes['dashboard']['side'] );
	unset( $wp_meta_boxes['dashboard']['normal'] );
	// Not Employees/Contractors.
	if ( ! current_user_can( 'edit_users' ) ) {
		return;
	}

	wp_add_dashboard_widget(
		'staff-overview',
		'Staff Overview of Users',
		function() {
			$all_users      = get_users();
			$today          = gmdate( 'Ymd' );
			$can_edit_users = current_user_can( 'edit_users' );

			echo '<div id="staff-overview-container">';
			echo '<table>';

			echo '<thead>' . wp_kses_post( sc_get_user_dashboard_cols( false, $can_edit_users ) ) . '</thead>';

			echo '<tbody>';
			foreach ( $all_users as $user ) {
				$data         = $user->data;
				$user_id      = $data->ID;
				$display_name = $data->display_name;

				// Assign documents to columns.
				$list_todo       = array();
				$list_processing = array();
				$list_uptodate   = array();
				$list_expired    = array();
				$list_other      = array();
				while ( have_rows( 'docs', 'user_' . $user_id ) ) {
					the_row();
					$is_existing = get_sub_field( 'select_exisiting' );
					$document    = $is_existing ? get_sub_field( 'document' ) : false;
					$doc_title   = $document ? get_the_title( $document ) : get_sub_field( 'title' );
					$doc_status  = get_sub_field( 'status' );
					$status      = $doc_status && $doc_status['value'] ? $doc_status['value'] : 'other';
					switch ( $status ) {
						case 'to-do':
							array_push( $list_todo, $doc_title );
							break;
						case 'processing':
							array_push( $list_processing, $doc_title );
							break;
						case 'up-to-date':
							array_push( $list_uptodate, $doc_title );
							break;
						case 'expired':
							array_push( $list_expired, $doc_title );
							break;
						default:
							array_push( $list_other, $doc_title );
							break;
					}
				}

				// Build column data.
				$doc_cols = array(
					array( $list_todo, 'to-do' ),
					array( $list_processing, 'processing' ),
					array( $list_uptodate, 'up-to-date' ),
					array( $list_expired, 'expired' ),
					array( $list_other, 'other' ),
				);

				// Start.
				echo '<tr>';

				// Name.
				echo '<td>';
				echo '<h3>' . esc_html( $display_name ) . '</h3>';
				echo '</td>';

				// Controls.
				if ( $can_edit_users ) {
					echo '<td class="center">';
					echo '<a class="button button-primary" href="' . esc_url( admin_url( 'user-edit.php?user_id=' . $user_id ) ) . '">Go to user profile</a>';
					echo '</td>';
				}

				// Document cols.
				array_walk(
					$doc_cols,
					function( $col ) {
						$list = $col[0];
						$slug = $col[1];

						echo '<td>';
						if ( count( $list ) ) {
							echo '<ul>';
							foreach ( $list as $doc_title ) {
								echo '<li>' . esc_html( $doc_title ) . '</li>';
							}
							echo '</ul>';
						}
						echo '</td>';

					}
				);

				echo '</tr>';
			}
			echo '</tbody>';

			echo '<tfoot>' . wp_kses_post( sc_get_user_dashboard_cols( true, $can_edit_users ) ) . '</tfoot>';

			echo '</table>';
		}
	);
}
add_action( 'wp_dashboard_setup', 'sc_dashboard_widgets' );

/**
 * WYSIWYG - Set to only Headings/Paragraphs and pasting text removes styles.
 *
 * @param Array $init The initialize args from WP.
 * @return Array Returns the update $init.
 */
function sc_set_tinymce_html( $init ) {
	$init['block_formats'] = 'Heading 2=h2;Heading 3=h3;Heading 4=h4;Paragraph=p';
	$init['paste_as_text'] = true;
	return $init;
}
add_filter( 'tiny_mce_before_init', 'sc_set_tinymce_html' );

/**
 * Remove unwanted WordPress TinyMCE buttons from first row.
 *
 * @param Array $buttons Buttons used in tinymce.
 * @return Array Returns reduced list of buttons.
 */
function sc_remove_tinymce_buttons( $buttons ) {
	$remove = array( 'wp_more', 'hr', 'wp_help', 'strikethrough' );
	return array_diff( $buttons, $remove );
}
add_filter( 'mce_buttons', 'sc_remove_tinymce_buttons', 2000 );
add_filter( 'mce_buttons_2', 'sc_remove_tinymce_buttons', 2020 );
