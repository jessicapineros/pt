<?php
/**
 * Template name: actuas
 *
 */?>

<!-- Header -->
<?php get_header('actualites'); ?>


<div class="content-custom-post-type">

    <?php if (is_user_logged_in() ): ?>

        <!-- welcome & form newsletter -->
        <?php include( get_template_directory() . '/inc/welcome-newsletter.php'); ?>


        <!-- WP Query custom poste type -->
        <?php $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1; ?>
        <?php $args = array(
            'post_type' => 'actualites',
            'order' => 'DESC',
            'posts_per_page' => 4,
            'paged' => $paged
        ); ?>

        <?php $wp_query = new WP_Query( $args ); ?>

        <?php  if ( $wp_query->have_posts()) : ?>

            <div class="articles-cpt">
            	<?php while ($wp_query->have_posts()) : $wp_query->the_post(); ?>

                  <div class="article-actuas">
                    <a href="<?php the_permalink(); ?>">
                      <div class="thumbnail-actuas" style="background-image: url('<?php echo get_the_post_thumbnail_url('', $post->id); ?>');"></div>
                    </a>
                    <div class="excerpt-article">
                      <a href="<?php the_permalink(); ?>"><h2><?php the_title(); ?></h2></a>
                      <p ><?php the_excerpt(); ?></p>
                    </div>
                    <div class="btn-discover">
                      <a href="<?php the_permalink(); ?>">Discover</a>
                    </div>
                  </div>

            <?php endwhile; ?>
            </div>
            <!-- Pagination -->
            <?php //bones_page_navi_press(); ?>
            <?php bones_page_navi(); ?>

          <?php else: ?>
            <p>No posts found</p>
        <?php endif; wp_reset_postdata();?>

      <?php else: ?>

        <!--Form connexion-->
        <?php include( get_template_directory() . '/inc/login-form.php'); ?>

    <?php endif; ?>
</div>

<!-- Footer -->
<?php get_footer('actualites'); ?>
