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
 * Renames Subscriber to Contractor.
 */
function rename_subscribers_to_contractors() {
	global $wp_roles;
	if ( isset( $wp_roles ) ) {
		$wp_roles->roles['subscriber']['name'] = 'Contractor';
		$wp_roles->role_names['subscriber']    = 'Contractor';
	}
}
add_action( 'init', 'rename_subscribers_to_contractors' );

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
	wp_enqueue_style( 'theme', tailpress_asset( 'css/app.css' ), array(), $theme->get( 'Version' ) );
	wp_enqueue_script( 'tailpress', tailpress_asset( 'js/app.js' ), array(), $theme->get( 'Version' ), true );

	// Font Awsome.
	wp_enqueue_style( 'fontawesome', get_stylesheet_directory_uri() . '/css/fontawesome/css/all.min.css', array(), '6.1.1' );

	// Slick.
	wp_enqueue_style( 'slick', get_stylesheet_directory_uri() . '/css/slick.min.css', array(), '1.0.1' );
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
 * Build a consistent Call-to-action element
 *
 * @param Array $opts Contains all the options needed to build the CTA.
 * @return String Returns HTML.
 */
function get_sc_cta( $opts = array() ) {
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
 * Get the Contractor Dashboard page
 * Uses the page template to return the first page using the template.
 *
 * @return Mixed The contractor dashboard page as Object or false as Boolean.
 */
function get_contractor_dashboard_page() {
	$dashboard_query = get_pages(
		array(
			'meta_key'   => '_wp_page_template',
			'meta_value' => 'page-contractor.php',
			'number'     => 1,
		),
	);
	return count( $dashboard_query ) ? $dashboard_query[0] : false;
}

/**
 * Get the permalink of the Contractor Dashboard page
 * Uses get_contractor_dashboard_page() to extract a permalink.
 *
 * @return Mixed Returns the permalink as a String or false Boolean
 */
function get_contractor_dashboard_permalink() {
	$page = get_contractor_dashboard_page();
	return isset( $page ) ? get_permalink( $page ) : false;
}

/**
 * Get the Subscribers/Contractors to the Contractor Dashboard page.
 *
 * @param  String $redirect_to The redirect destination URL.
 * @param  String $request The requested redirect destination URL passed as a parameter.
 * @param  Mixed  $user (WP_User|WP_Error) WP_User object if login was successful, WP_Error object otherwise.
 * @return String The Contractor Dashboard page, home URL, or redirect link.
 */
function redirect_contractors( $redirect_to, $request, $user ) {
	if ( isset( $user->roles ) && is_array( $user->roles ) ) {
		$is_subscriber = in_array( 'subscriber', $user->roles, true );
		$cd_permalink  = $is_subscriber ? get_contractor_dashboard_permalink() : false;
		if ( $cd_permalink ) {
			return $cd_permalink;
		} else {
			return home_url();
		}
	} else {
		return $redirect_to;
	}
}
add_filter( 'login_redirect', 'redirect_contractors', 10, 3 );

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
 * Figure out if the User's Document attachment is a Document or just files and notes.
 *
 * @param Array  $item A repeater row.
 * @param String $key  The field slug.
 * @return Mixed Can be anything.
 */
function get_contractor_field( $item = array(), $key = '' ) {
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
				if ( $today > $expiry_date ) {
					array_push( $expired, $notice_text );
					// Update to expired, if not already.
					if ( 'expired' !== $doc_status['value'] ) {
						update_sub_field( 'status', 'expired' );
					}
				} else {
					$month_ahead = gmdate( 'Ymd', strtotime( '-1 months', strtotime( $expiry_date ) ) );
					if ( $today > $month_ahead ) {
						array_push( $soon, $notice_text );
					}
				}
			}
		}
	}
	// Not contractors.
	global $current_user;
	if ( isset( $current_user->roles ) && is_array( $current_user->roles ) ) {
		$is_subscriber = in_array( 'subscriber', $current_user->roles, true );
		if ( $is_subscriber ) {
			return;
		}
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
