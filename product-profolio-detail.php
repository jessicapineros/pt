<?php
/**
 * The template for displaying all pages
 * Template name: product portfolio detail
 *
 * @subpackage puretrade
 * @since puretrade 1.0
 */
get_header();
?>
<!--<h2><?php //the_title(); ?></h2>-->
<!--<span class="back-btn" onclick="window.history.back()">Back</span>-->
<div id = "product-slider" class="product-slider">
  <ul id="boutique">
    <?php
    $pagename = get_query_var('pagename');
    $args = array('post_type' => 'post', 'category_name' => $pagename, 'posts_per_page' => -1, 'orderby' => 'post_date', 'order' => 'ASC');
    query_posts($args);
    while (have_posts()): the_post();
      ?>
      <li class="popup-container">
          <img src="<?php the_field('slider_image') ?>" alt="<?php the_title(); ?>"/>
        </li>
     <?php
    endwhile;
    ?>
  </ul>
</div>
<?php get_footer(); ?>
