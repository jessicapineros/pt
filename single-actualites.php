<!--header custom post type -->
<?php get_header('actualites');?>

<div class="content-custom-post-type ptop">
  <?php if (is_user_logged_in()): ?>

    <!-- welcome & form newsletter -->
    <?php include( get_template_directory() . '/inc/welcome-newsletter.php'); ?>


    <!-- Content post -->
    <div class="single-container">

      <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

            <!-- Title -->
            <h1><?php the_title(); ?></h1>

            <!-- Thumbnail -->
            <div class="post-thumbnail" style="background-image: url('<?php echo get_the_post_thumbnail_url('', $post->id); ?>');"></div>

            <!-- Content -->
            <div class="content-single">
                <p><?php the_content(); ?></p>
                <div class="author-post">
                    <p>Author : <a href="<?php the_permalink(); ?>"><?php the_author(); ?></a></p>
                    <p>Date : <?php the_date(); ?></p>
                </div>
            </div>

          <?php endwhile; ?>
        <?php else: ?>
            <p>No posts found</p>
        <?php endif; wp_reset_query(); ?>
    </div>

    <!-- Last posts-->
    <div class="single-last-posts">

      <h2>OUR SELECTION OF ARTICLES FOR YOU</h2>

      <div class="articles-cpt">

        <?php $currentID = get_the_ID(); ?>
        <?php $args = array(
            'post_type' => 'actualites',
            'order' => 'DESC',
            'posts_per_page' => 3,
            'post__not_in' => array($currentID)
        ); ?>

        <?php $wp_query = new WP_Query( $args ); ?>

        <?php  if ( $wp_query->have_posts()) : ?>

            <?php while ($wp_query->have_posts()) : $wp_query->the_post(); ?>

              <div class="article-actuas">
                <a href="<?php the_permalink(); ?>">
                  <div class="thumbnail-actuas" style="background-image: url('<?php echo get_the_post_thumbnail_url('', $post->id); ?>');"></div>
                </a>
                <div class="excerpt-article">
                  <a href="<?php the_permalink(); ?>"><h2><?php the_title(); ?></h2></a>
                  <p ><?php the_excerpt(); ?></p>
                </div>
              </div>
          <?php endwhile; ?>

        <?php else: ?>
          <p>No posts found</p>

      <?php endif; wp_reset_postdata();?>
      </div>
    </div>

    <?php else: ?>

    <!--Form connexion-->
    <?php include( get_template_directory() . '/inc/login-form.php'); ?>

  <?php endif; ?>
  </div>

<!-- Footer -->
<?php get_footer('actualites'); ?>
