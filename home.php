<?php
/**
 * The template for displaying all pages
 * Template name: homenew
 *
 * @subpackage puretrade
 * @since puretrade 1.0
 */
get_header();
?>

<!--<div id = "home-slider" class="home-slider">-->
<!--  <div class = "slides">-->

<div class="header-logo">
  <a href="<?php echo home_url(); ?>/<?php echo the_field('home-page-logo-link');?>/" title="<?php bloginfo('name'); ?>">
    <img src="<?php the_field('logo_image', 5) ?>" alt="<?php the_field('logo_alt_text', 5) ?>" />
  </a>
</div>
<div class="content-description">
<?php
while (have_posts()): the_post();
  ?>

  <?php
  the_content();
endwhile;
?>

<?php
$args = array('post_type' => 'post', 'category__and' => array(32), 'order' => 'ASC', 'posts_per_page' => -1, 'orderby' => 'post_date');
query_posts($args);
while (have_posts()): the_post();
  echo '<div class="site-detalis'. $post->post_name .'">';
  echo '<p><a href="' . home_url() .'/'. get_field('page_link') .'/"><span>' . get_the_title() . '</span><span>' . get_the_content() . '</span></a></p>';
  echo '</div>';
endwhile;

/* Restore original Post Data */
?>
  </div>
<?php get_footer(); ?>
