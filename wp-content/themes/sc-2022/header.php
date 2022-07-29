<?php
/**
 * Header.
 *
 * @package sanday
 * @since 0.0.0
 */

$site_name      = get_bloginfo( 'name' );
$site_url       = get_bloginfo( 'url' );
$stylesheet_uri = get_stylesheet_directory_uri();

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

	<link rel="apple-touch-icon" sizes="180x180" href="<?php echo esc_url( $stylesheet_uri ); ?>/img/meta/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="<?php echo esc_url( $stylesheet_uri ); ?>/img/meta/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="<?php echo esc_url( $stylesheet_uri ); ?>/img/meta/favicon-16x16.png">
	<link rel="manifest" href="<?php echo esc_url( $stylesheet_uri ); ?>/img/meta/site.webmanifest">
	<link rel="mask-icon" href="<?php echo esc_url( $stylesheet_uri ); ?>/img/meta/safari-pinned-tab.svg" color="#5bbad5">
	<link rel="shortcut icon" href="<?php echo esc_url( $stylesheet_uri ); ?>/img/meta/favicon.ico">
	<meta name="apple-mobile-web-app-title" content="Sanday Construction Ltd.">
	<meta name="application-name" content="Sanday Construction Ltd.">
	<meta name="msapplication-TileColor" content="#da532c">
	<meta name="msapplication-config" content="<?php echo esc_url( $stylesheet_uri ); ?>/img/meta/browserconfig.xml">
	<meta name="theme-color" content="#1d1e1b">

	<?php wp_head(); ?>
</head>

<body <?php body_class( 'bg-dark text-light antialiased' ); ?>>

<?php do_action( 'tailpress_site_before' ); ?>

<div id="page" class="min-h-screen flex flex-col">

	<?php do_action( 'tailpress_header' ); ?>

	<header id="site-header" class="relative lg:fixed left-0 top-0 w-full z-10 bg-dark lg:bg-transparent text-white transition-colors duration-500">
		<!-- Gradient -->
		<div class="gradient absolute inset-0 hidden lg:block transition-opacity duration-200"></div>

		<div class="container relative px-2.5 xl:px-5">
			<div class="flex flex-col lg:flex-row justify-between items-end lg:items-center pt-1 pb-5 lg:pb-4">
				<!-- Logo and Menu btn -->
				<div class="w-full lg:w-auto flex justify-between items-center">
					<div>
						<a id="site-logo" class="max-w-site-logo p-2 block text-md font-bold uppercase" href="<?php echo esc_url( $site_url ); ?>" title="Home - <?php echo esc_attr( $site_name ); ?>">
							<img src="<?php echo esc_attr( get_stylesheet_directory_uri() ); ?>/img/sanday-construction-logo-horizontal-white.png" width="1024" height="406" alt="<?php echo esc_attr( $site_name ); ?> logo">
						</a>
					</div>

					<div class="lg:hidden">
						<button id="primary-menu-toggle" class="fa fa-bars text-2xl" title="Toggle navigation"></button>
					</div>
				</div>

				<nav id="primary-menu" class="lg:w-auto flex lg:flex flex-col lg:flex-row items-end lg:items-center toggled-hidden">
					<?php
					wp_nav_menu(
						array(
							'theme_location'  => 'nav',
							'container_id'    => 'site-nav',
							'container_class' => 'mb-4 lg:mb-0 last:mb-0 lg:mr-4 lg:last:mr-0 text-right lg:text-center',
							'menu_class'      => 'lg:flex items-center',
							'li_class'        => 'mb-2 lg:mb-0 last:mb-0  lg:mr-4 lg:last:mr-0',
							'anchor_class'    => 'lg:px-1 py-0.5 block border-2 border-transparent lg:hover:border-b-white focus:border-b-white text-xl leading-none transition-colors duration-500',
						)
					);

					// Social Media.
					sc_build_social_media_links();

					// CTAs.
					sc_build_ctas();

					?>
				</nav>
			</div>
		</div>
	</header>

	<div id="content" class="site-content flex-grow">

		<?php
		// Banner.
		get_template_part( 'template-parts/banner' );
		?>

		<main>
