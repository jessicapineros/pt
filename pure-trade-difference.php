<?php
/**
 * The template for displaying all pages
 * Template name: pure trade difference
 *
 * @subpackage puretrade
 * @since puretrade 1.0
 */
get_header();
?>
<?php
while (have_posts()): the_post();
  ?>
  <div class="trusted-choice">
    <h2> <?php the_title(); ?></h2> 
    <div>
      <?php
      the_content();
    endwhile;
    ?>
  </div>
</div>
<?php
if ($pagename == 'the-pure-trade-difference')
  $count = 1;
?>
<ul class="tabs">
  <?php
  $args = array('post_type' => 'post', 'category__and' => array(2), 'posts_per_page' => -1,  'orderby' => 'post_date');
  query_posts($args);
  while (have_posts()): the_post();
    ?>
    <li data-class="<?php echo $count; ?>">
      <div class="accordian-list" data-class="<?php echo $count; ?>">
        <div class="score-toggle <?php echo $count == 1 ? 'active-link' : ''; ?>">
          <div class="accordian-image" style="background-image: url(<?php the_field('tab_icon') ?>)">
<!--            <img src="<?//php the_field('accordian_icon') ?>"/>-->
          </div>
          <div class="accordian-image-hover" style="background-image: url(<?php the_field('tab_icon_active') ?>)"></div>
          <h3><?php the_title(); ?></h3>
        </div>

      </div>
    </li>
    <?php
    $count++;
  endwhile;
  ?> 
</ul>
<div class="tab-content">
  
<!--  <ul>
    <li>-->
  <?php
  $args = array('post_type' => 'post', 'category__and' => array(2), 'posts_per_page' => -1, 'orderby' => 'post_date');
  query_posts($args);
  while (have_posts()): the_post();
    ?>

    <div class="monitoring-information">
      <?php
      the_content();
      ?>  
    </div>

    <?php
  endwhile;

  ?>
<!--            </li>
  </ul>-->
</div>

<?php get_footer(); ?>
