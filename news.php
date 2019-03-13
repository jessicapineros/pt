<?php
/**
 * The template for displaying all pages
 * Template name: news
 *
 * @subpackage puretrade
 * @since puretrade 1.0
 */
get_header();
?>
<?php
while (have_posts()): the_post();
  ?>
<div>
  <h2> <?php the_title(); ?></h2> 
  <div>
    <?php
    the_content();
  endwhile;
  ?>
</div>
</div>
<section class="content-subpage">
  <?php
  $args = array('post_type' => 'post', 'category__and' => array(10), 'posts_per_page' => -1, 'orderby' => 'post_date', 'order' => 'Desc');
  query_posts($args);
  if( have_posts() ){
    while (have_posts()): the_post();
    $cats = get_the_category();
    $cat_name = $cats[0]->name == 'News' ? $cats[1]->name : $cats[0]->name;
    echo '<article>';
    $dat_cur = $post->post_date;
    $dat_cur = date('d', strtotime($dat_cur)) . "<sup>" . date('S', strtotime($dat_cur)) . "</sup> " . date('F', strtotime($dat_cur));
    echo '<div class="cat-header">';
    echo '<h3><a href="' . get_permalink() . '">' . get_the_title() . '</a></h3>';
    echo '<p class="cat-list"><span class="cat-name">' . $cat_name . '</span><span> | </span><span class="cat-date">' . $dat_cur . '</span></p></div>';
    echo '<p class="feed-para">';
    the_post_thumbnail('medium');
    echo get_the_excerpt() . '</p>';
    echo '<p class="content-more"><a href="' . get_permalink() . '" title="Read more">Read more</a></p>';
    echo '</article>';
    endwhile;
  } else {
    echo '<p class="content-more"><a>Check Back Soon for New Updates and Events</a></p>';
  }
  
  ?>
</section>
<?php get_footer(); ?>
