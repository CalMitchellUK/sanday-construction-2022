<?php
/**
 * The main functionality of the theme.
 *
 * @package sanday
 * @since 0.0.0
 */

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
	wp_enqueue_style( 'google-fonts', 'https://fonts.googleapis.com/css2?family=Merriweather:wght@400;700&family=Roboto:wght@400;500;700&display=swap', array(), $theme->get( 'Version' ) );

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
	$target    = isset( $opts['target'] ) ? $opts['target'] : '_blank';
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
