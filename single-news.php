<?php
/**
 * The Template for displaying all single posts.
 *
 */
get_header();
?>
<section class="content-subpage news">
  <article>
    <?php
    $cats = get_the_category();
    $cat_name = $cats[0]->name == 'News' ? $cats[1]->name : $cats[0]->name;
        $dat_cur = $post->post_date;
    $dat_cur = date('d', strtotime($dat_cur)) . "<sup>" . date('S', strtotime($dat_cur)) . "</sup> " . date('F', strtotime($dat_cur));
    ?>
    <h3><?php the_title(); ?></h3> 
    <span class="back-btn" onclick="window.history.back()">Back</span>
    <?php
    setup_postdata($post);
    echo '<p class="cat-list publication-details"><span class="cat-name">' . $cat_name . '</span><span> | </span><span class="cat-date">' . $dat_cur . '</span></p>';
    //the_post_thumbnail('medium');
    the_content();
    ?>
  </article>
</section>
<?php get_footer(); ?>
