<?php
/**
 * The site HTML head.
 *
 * @package sanday
 * @since 0.0.0
 */

$site_name = get_bloginfo( 'name' );
$site_url  = get_bloginfo( 'url' );

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

	<?php wp_head(); ?>
</head>

<body <?php body_class( 'bg-dark text-light antialiased' ); ?>>

<?php do_action( 'tailpress_site_before' ); ?>

<div id="page" class="min-h-screen flex flex-col">

	<?php do_action( 'tailpress_header' ); ?>

	<header id="site-header" class="relative md:fixed left-0 top-0 w-full z-10 text-white transition-colors duration-500">
		<!-- Gradient -->
		<div class="gradient absolute inset-0 block transition-opacity duration-200"></div>

		<div class="container relative px-2.5 xl:px-5">
			<div class="lg:flex justify-between items-center pt-1 pb-4">
				<div class="flex justify-between items-center">
					<div>
						<a id="site-logo" class="max-w-site-logo p-2 block text-md font-bold uppercase" href="<?php echo esc_url( $site_url ); ?>" title="Home - <?php echo esc_attr( $site_name ); ?>">
							<img src="<?php echo esc_attr( get_stylesheet_directory_uri() ); ?>/img/sanday-construction-logo-horizontal-white.png" width="1024" height="406" alt="<?php echo esc_attr( $site_name ); ?> logo">
						</a>
					</div>

					<div class="lg:hidden">
						<button id="primary-menu-toggle" class="fa fa-bars text-2xl" title="Toggle navigation"></button>
					</div>
				</div>

				<nav id="primary-menu" class="mt-4 lg:mt-0 hidden lg:flex items-center">
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'nav',
							'container_id'   => 'site-nav',
							'menu_class'     => 'lg:mr-4 lg:flex items-center',
							'li_class'       => 'lg:mr-4 lg:last:mr-0',
							'anchor_class'   => 'px-1 py-0.5 block border-2 border-transparent lg:hover:border-b-white focus:border-b-white text-xl leading-tight transition-colors duration-500',
						)
					);
					?>
					<ul class="lg:m-2 flex items-center">
						<li class="mr-2.5 last:mr-0">
							<a class="w-9 h-9 p-2 block lg:hover:bg-white focus:bg-white lg:hover:text-black focus:text-black text-lg leading-none text-center transition-colors duration-500 fa-brands fa-facebook-f" href="https://www.facebook.com/SANDAYCONSTRUCTION/" target="_blank" title="Follow us on facebook" rel="nofollow"></a>
						</li>
						<li class="mr-2.5 last:mr-0">
							<?php
							$free_quote = array(
								'href' => '#free-quote',
								'text' => 'Get a free quote',
								'icon' => 'fa fa-file-pen',
							);
							echo wp_kses_post( get_sc_cta( $free_quote ) );
							?>
						</li>
					</ul>
				</nav>
			</div>
		</div>
	</header>

	<div id="content" class="site-content flex-grow">

		<?php
		$banner_image = get_field( 'banner_image' );
		if ( $banner_image ) {
			?>
			<div id="page-banner-image" class="relative w-full max-h-40vh md:max-h-75vh overflow-hidden">
				<div class="relative w-full pb-video"></div>
				<?php echo wp_get_attachment_image( $banner_image, 'banner-image', null, array( 'class' => 'absolute left-0 top-0 w-full h-full object-cover' ) ); ?>
			</div>
			<?php
		} else {
			?>
			<div id="site-header-buffer" class="relative w-full hidden md:block"></div>
			<?php
		}
		?>

		<main>
