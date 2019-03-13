<?php
/**
 * Template name: production
 *
 */?>

<!-- Header -->
<?php get_header('actualites'); ?>

<div class="content-custom-post-type">
  <?php if (is_user_logged_in() ): ?>

      <!-- welcome & form newsletter -->
      <?php include( get_template_directory() . '/inc/welcome-newsletter.php'); ?>


      <!-- WP Query content post-->
      <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

          <p><?php the_content() ?></p>

          <!-- Gallery -->
          <div class="container-gallery">
            <!-- WP Query - Gallery -->
            <?php if( have_rows('gallery_space_client') ): ?>

              <?php while( have_rows('gallery_space_client') ): the_row();

                    $image = get_sub_field('image_gallery');?>

                    <figure>
                      <a href="<?php echo $image['url']; ?>" data-lightbox="gallery" class="image-scroll">
                        <figcaption><img src="<?php echo get_template_directory_uri(); ?>/images/plus@1x-1.png" alt="plus"></figcaption>
                        <div class="image-gallery" style="background-image: url(<?php echo $image['url']; ?>)"></div>
                      </a>
                    </figure>

              <?php endwhile; ?>
            <?php endif; ?>
          </div>

          <?php endwhile; ?>
        <?php else: ?>
          <p>No posts found</p>
        <?php endif; ?>

<?php else: ?>

    <!--Formulaire connexion-->
    <?php include( get_template_directory() . '/inc/login-form.php'); ?>

<?php endif; ?>
</div>

<!-- Footer -->
<?php get_footer('actualites'); ?>
