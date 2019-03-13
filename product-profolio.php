<?php
/**
 * The template for displaying all pages
 * Template name: product portfolio
 *
 * @subpackage puretrade
 * @since puretrade 1.0
 */
get_header();
?>
<?php
while (have_posts()): the_post();
  ?>
<!--  <h2> <?php //the_title(); ?></h2> -->
  <div>
    <?php
    //the_content();
  endwhile;
  ?>
</div>
<?php wp_nav_menu(array('theme_location' => 'primary', 'container' => 'div', 'menu_class' => 'content-nav cf')) ?>
<?php get_footer(); ?>
