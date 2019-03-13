<?php
/**
 * The template for displaying all pages
 * Template name: how we work
 *
 * @subpackage puretrade
 * @since puretrade 1.0
 */
get_header();
?>
<?php
while (have_posts()): the_post();
  the_content();
endwhile;
?>
<?php $count = 1 ?>
<div id = "home-slider" class="home-slider how-we-are-slider">
  <div class = "slides">
    <?php
    $args = array('post_type' => 'post', 'category__and' => array(20), 'posts_per_page' => -1, 'orderby' => 'post_date', 'order' => 'ASC');
    query_posts($args);
    while (have_posts()): the_post();
      ?>
      <div class="step<?php echo $count ?>">
        <img src="<?php the_field('slider_image') ?>"/>
        <div>
          <span class="step<?php echo $count ?>" style='display: none;'><?php the_field('thumbnail_image') ?></span>
          <?php $count++ ?>
          <?php the_content(); ?>
        </div>
      </div>
      <?php
    endwhile;
    ?>
  </div>
</div>

<?php get_footer(); ?>
