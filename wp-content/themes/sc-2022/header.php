<!DOCTYPE html>
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

<body <?php body_class( 'bg-light text-dark antialiased' ); ?>>

<?php do_action( 'tailpress_site_before' ); ?>

<div id="page" class="min-h-screen flex flex-col">

	<?php do_action( 'tailpress_header' ); ?>

	<header id="site-header" class="fixed left-0 top-0 w-full z-10 text-white transition-colors duration-500">

		<div class="container">
			<div class="lg:flex lg:justify-between lg:items-center py-6">
				<div class="flex justify-between items-center">
					<div>
						<?php if ( has_custom_logo() ) { ?>
							<?php the_custom_logo(); ?>
						<?php } else { ?>
							<div class="text-lg uppercase">
								<a href="<?php echo get_bloginfo( 'url' ); ?>" class="font-extrabold text-lg uppercase">
									<?php echo get_bloginfo( 'name' ); ?>
								</a>
							</div>
						<?php } ?>
					</div>

					<div class="lg:hidden">
						<a href="#" aria-label="Toggle navigation" id="primary-menu-toggle">
							<svg viewBox="0 0 20 20" class="inline-block w-6 h-6" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
								<g stroke="none" stroke-width="1" fill="currentColor" fill-rule="evenodd">
									<g id="icon-shape">
										<path d="M0,3 L20,3 L20,5 L0,5 L0,3 Z M0,9 L20,9 L20,11 L0,11 L0,9 Z M0,15 L20,15 L20,17 L0,17 L0,15 Z" id="Combined-Shape"></path>
									</g>
								</g>
							</svg>
						</a>
					</div>
				</div>

				<?php
				wp_nav_menu(
					array(
						'container_id'    => 'primary-menu',
						'container_class' => 'mt-4 lg:mt-0 hidden lg:block',
						'menu_class'      => 'lg:flex',
						'theme_location'  => 'primary',
						'li_class'        => 'lg:mr-4 lg:last:mr-0',
						'anchor_class'    => 'w-full block',
						'fallback_cb'     => false,
					)
				);
				?>
			</div>
		</div>
	</header>

	<div id="content" class="site-content flex-grow">

		<?php
		$banner_image = get_field( 'banner_image' );
		if ( $banner_image ) {
			echo '<div id="page-banner-image" class="relative w-full max-h-60vh overflow-hidden">';
			// Ratio.
			echo '<div class="relative w-full pb-video"></div>';
			// IMG.
			echo wp_get_attachment_image( $banner_image, 'full', null, array( 'class' => 'absolute left-0 top-0 w-full h-full object-cover' ) );
			// Overlay.
			echo '<div class="absolute inset-0 bg-dark bg-opacity-50"></div>';
			echo '</div>';
		}
		?>

		<main>
