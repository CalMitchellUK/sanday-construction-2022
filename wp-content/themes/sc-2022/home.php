<?php
/**
 * Template Name: Home
 * Description: The default template for the homepage.
 *
 * @package sanday
 * @since 0.0.0
 */

get_header();

$main_text = get_field( 'main_text' );

?>
	<!-- Main Text -->
	<div class="container relative px-2.5 xl:px-5">

		<div class="half-height-offset w-full xl:w-3/4 mb-10">

			<div class="bg-light text-dark p-8 drop-shadow">

				<h1 class="text-3xl xl:text-5xl 2xl:text-6xl"><?php echo esc_html( $main_text ); ?></h1>

			</div>

		</div>
	</div>
	<!--  -->

	<!-- Key Information -->
	<div class="container relative px-0 py-8 xl:py-10">
		<div class="mb-10 md:flex">
			<?php
			$ki_arr  = get_field( 'key_information' ) ?? array();
			$ki_col1 = $ki_arr['column_1'] ?? array();
			$ki_col2 = $ki_arr['column_2'] ?? array();
			$ki_col3 = $ki_arr['column_3'] ?? array();
			$ki_cols = array( $ki_col1, $ki_col2, $ki_col3 );
			foreach ( $ki_cols as $ki_col ) {
				// Image.
				$img     = isset( $ki_col['image'] ) ? $ki_col['image'] : array();
				$img_src = isset( $img['sizes'] ) ? $img['sizes']['card'] : '';
				$img_alt = isset( $img['alt'] ) ? $img['alt'] : '';
				// Text.
				$card_title = isset( $ki_col['title'] ) ? $ki_col['title'] : '';
				$card_text  = isset( $ki_col['text'] ) ? $ki_col['text'] : '';
				?>
				<div class="w-full md:w-1/3 px-2.5 xl:px-5 flex flex-col">
					<div class="grow flex flex-col bg-light text-dark">
						<img class="block" src="<?php echo esc_url( $img_src ); ?>" width="1280" height="720" alt="<?php echo esc_attr( $img_alt ); ?>">
						<div class="p-2.5 xl:p-5 flex flex-col grow">
							<h2 class="mb-3 text-lg xl:text-2xl"><?php echo esc_html( $card_title ); ?></h2>
							<p class=""><?php echo wp_kses_post( $card_text ); ?></p>
						</div>
					</div>
				</div>
				<?php
			}
			?>
		</div>

	</div>

<?php

get_footer();
