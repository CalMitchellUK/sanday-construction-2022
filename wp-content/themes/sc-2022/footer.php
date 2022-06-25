<?php
$all_navs          = get_nav_menu_locations();
// Site map.
$sitemap_id        = 'sitemap';
$sitemap_nav       = get_term( $all_navs[ $sitemap_id ], 'nav_menu' );
$sitemap_nav_count = $sitemap_nav->count;
$sitemap_nav_name  = $sitemap_nav->name;
// Useful links.
$useful_id        = 'useful';
$useful_nav       = get_term( $all_navs[ $useful_id ], 'nav_menu' );
$useful_nav_count = $useful_nav->count;
$useful_nav_name  = $useful_nav->name;
// Column info.
$h2_classes      = 'mb-4 text-lg';
$container_class = 'mb-8 last:mb-0';
$menu_class      = '';
$li_class        = 'mb-2 last:mb-0';
$anchor_class    = 'inline-flex items-center focus:underline lg:hover:underline';

?>
</main>

<?php do_action( 'tailpress_content_end' ); ?>

</div>

<?php do_action( 'tailpress_content_after' ); ?>

<footer id="site-footer" class="py-12 bg-black" role="contentinfo">
	<?php do_action( 'tailpress_footer' ); ?>

	<div class="container flex flex-wrap text-center md:text-left">
		<div class="w-full md:w-1/4 mb-3 md:mb-0 px-2.5 xl:px-5">
			<?php
			if ( $sitemap_nav_count ) {
				echo '<h2 class="' . esc_attr( $h2_classes ) . '">' . esc_html( $sitemap_nav_name ) . '</h2>';
				wp_nav_menu(
					array(
						'theme_location'  => $sitemap_id,
						'container_class' => $container_class,
						'menu_class'      => $menu_class,
						'li_class'        => $li_class,
						'anchor_class'    => $anchor_class,
						'link_after'      => '<i class="ml-2 text-sm leading-none fa"></i>',
					)
				);
			}
			?>
			<div>
				<img src="<?php echo esc_attr( get_stylesheet_directory_uri() ); ?>/img/sanday-construction-ident-white.png" width="80" height="68" alt="<?php echo esc_attr( $site_name ); ?> ident">
			</div>
		</div>

		<?php
		if ( $useful_nav_count ) {
			echo '<div class="w-full md:w-1/4 mb-3 md:mb-0 px-2.5 xl:px-5">';
			echo '<h2 class="' . esc_attr( $h2_classes ) . '">' . esc_html( $useful_nav_name ) . '</h2>';
			wp_nav_menu(
				array(
					'theme_location'  => $useful_id,
					'container_class' => $container_class,
					'menu_class'      => $menu_class,
					'li_class'        => $li_class,
					'anchor_class'    => $anchor_class,
					'link_after'      => '<i class="ml-1 text-sm leading-none fa"></i>',
				)
			);
			echo '</div>';
		}
		?>

		<div class="md:ml-auto px-2.5 xl:px-5 self-end">
			&copy; <?php echo date_i18n( 'Y' );?> - <?php echo get_bloginfo( 'name' );?>
		</div>
	</div>
</footer>

</div>

<?php wp_footer(); ?>

</body>
</html>
