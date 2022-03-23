<?php

/**
 * Theme setup.
 */
function tailpress_setup() {
	add_theme_support( 'title-tag' );

	register_nav_menus(
		array(
			'primary' => __( 'Primary Menu', 'tailpress' ),
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
function tailpress_enqueue_scripts() {
	$theme = wp_get_theme();

	wp_enqueue_style( 'tailpress', tailpress_asset( 'css/app.css' ), array(), $theme->get( 'Version' ) );
	wp_enqueue_script( 'tailpress', tailpress_asset( 'js/app.js' ), array(), $theme->get( 'Version' ), true );
}

add_action( 'wp_enqueue_scripts', 'tailpress_enqueue_scripts' );

/**
 * Get asset path.
 *
 * @param string  $path Path to asset.
 *
 * @return string
 */
function tailpress_asset( $path ) {
	if ( wp_get_environment_type() === 'production' ) {
		return get_stylesheet_directory_uri() . '/' . $path;
	}

	return add_query_arg( 'time', time(),  get_stylesheet_directory_uri() . '/' . $path );
}

/**
 * Adds option 'li_class' to 'wp_nav_menu'.
 *
 * @param string  $classes String of classes.
 * @param mixed   $item The curren item.
 * @param WP_Term $args Holds the nav menu arguments.
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
 * @param mixed   $item The curren item.
 * @param WP_Term $args Holds the nav menu arguments.
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

add_filter(
	'nav_menu_link_attributes',
	function( $classes, $item, $args ) {
		if ( isset( $args->anchor_class ) ) {
			$classes['class'] = $args->anchor_class;
		}
		return $classes;
	},
	1,
	3
);

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
