<?php
/**
 * Template Name: Home
 * Description: The default template for the homepage.
 *
 * @package sanday
 * @since 0.0.0
 */

get_header();

?>

<div class="py-8">

  <div class="container px-0">

    <?php get_template_part( 'template-parts/content', get_post_format() ); ?>

  </div>
</div>

<?php
get_footer();
