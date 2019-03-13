<?php
/**
 * The template for displaying all pages
 * Template name: clients
 *
 * @subpackage puretrade
 * @since puretrade 1.0
 */
get_header();
?>
<!--<h2> <?php //the_title(); ?></h2> -->
<div>
  <?php
  $args = array('post_type' => 'post', 'category__and' => array(17), 'posts_per_page' => -1, 'orderby' => 'post_date');
  query_posts($args);
  $count = 0;
  while (have_posts()): the_post();
    echo '<p><span>' . get_the_content() . '</span></p>';
    $count++;
    if ($count % 6 == 0) {
      echo '</div><div>';
    }
  endwhile;
  ?>
</div>
<?php get_footer(); ?>
