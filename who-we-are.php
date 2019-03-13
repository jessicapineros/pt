<?php
/**
 * The template for displaying all pages
 * Template name: who we are
 *
 * @subpackage puretrade
 * @since puretrade 1.0
 */
get_header();
?>
<?php
while (have_posts()): the_post();
  ?>
  <h2> <?php the_title(); ?></h2> 
  <div>
    <?php
    the_content();
  endwhile;
  ?>
</div>
  <div>
    <?php the_field('content_description') ?>
  </div>
<?php get_footer(); ?>
