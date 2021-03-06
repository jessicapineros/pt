<?php
/**
 * The template for displaying all pages
 * Template name: Environmental-protection
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other 'pages' on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage puretrade
 * @since puretrade 1.0
 */

get_header(); ?>

<?php
$args = array('post_type' => 'post', 'category__and' => array(37), 'posts_per_page' => -1, 'order' => 'ASC', 'orderby' => 'post_date');
  query_posts($args);
  while (have_posts()): the_post();
    echo '<div><h2>';
    the_title();
    echo '</h2><div>';
    the_content();
    echo '</div></div>';
    endwhile;
  ?>

 <?php 
get_footer();
?>