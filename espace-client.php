<?php
/**
 * The template for displaying all pages
 * Template name: espace client
 *
 */?>

 <!--header-->
<?php get_header('actualites'); ?>


<div class="content-custom-post-type">

  <?php if ( ! is_user_logged_in() ) : ?>

    <!--Submenu-->
    <div class="test-fixed"> </div>

    <!--Formulaire connexion-->
    <?php include( get_template_directory() . '/inc/login-form.php'); ?>

  <?php else: ?>

    <div class="welcome">
      <h1>CREATIVE PLATFORM - </h1>
      <p><?php  echo ' Welcome ' . $current_user->user_firstname. '.';?></p>
      <div class="sing-out">
        <?php echo '<a href="' . wp_logout_url( site_url( '/' ) ) .'"> SING OUT</a>'; ?>
      </div>
    </div>

  <?php endif; ?>
</div>

<!-- Footer -->
<?php get_footer('actualites'); ?>
