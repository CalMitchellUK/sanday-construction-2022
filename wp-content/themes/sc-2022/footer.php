
</main>

<?php do_action( 'tailpress_content_end' ); ?>

</div>

<?php do_action( 'tailpress_content_after' ); ?>

<footer id="colophon" class="site-footer py-12" role="contentinfo">
	<?php do_action( 'tailpress_footer' ); ?>

	<div class="container md:flex justify-between items-end text-center md:text-left">
		<div class="mb-3 md:mb-0 px-2.5 xl:px-5">
			<img src="<?php echo esc_attr( get_stylesheet_directory_uri() ); ?>/img/sanday-construction-ident-white.png" width="80" height="68" alt="<?php echo esc_attr( $site_name ); ?> ident">
		</div>

		<div class="px-2.5 xl:px-5">
			&copy; <?php echo date_i18n( 'Y' );?> - <?php echo get_bloginfo( 'name' );?>
		</div>
	</div>
</footer>

</div>

<?php wp_footer(); ?>

</body>
</html>
