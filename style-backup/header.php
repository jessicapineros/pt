<?php
/**
 * The Header for our theme
 *
 * 
 * 
 * @subpackage puretrade
 * @since puretrade 1.0
 */
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8) ]><!-->
<html <?php language_attributes(); ?>>
  <!--<![endif]-->
  <head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <title><?php wp_title('|', true, 'right'); ?></title>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,300' rel='stylesheet'>
    <link rel="icon" type="image/x-icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.ico">
    <!--[if lt IE 9]>
    <script src="<?php echo get_template_directory_uri(); ?>/js/html5.js"></script>
    <![endif]-->
    <?php wp_head(); ?>
    <script src="<?php echo get_template_directory_uri(); ?>/js/jquery-1.8.3.min.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/js/vendor/jquery.flexslider-min.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/js/vendor/jquery.easing.js"></script>
    <link href="<?php echo get_template_directory_uri(); ?>/css/boutique.css" rel='stylesheet'>
  </head>

  <body <?php body_class(); ?>>
    <div id="container" class="container calibri cf">
      <div class="wrapper">
        <header class="cf">
          <h1 class="site-title">
            <a href="<?php echo esc_url(home_url('/')); ?>" title="<?php bloginfo('name'); ?>">
              <img src="<?php the_field('logo_image', 5) ?>" alt="<?php the_field('logo_alt_text', 5) ?>" />
            </a>
          </h1>
          <nav>
            <?php wp_nav_menu(array('container' => '', 'menu_class' => 'nav-menu')); ?>
            <ul class="sub-menu sub-nav-remove"></ul>
          </nav>
        </header>
        <?php
        $pagename = get_query_var('pagename');
        $parentname = get_post($pagename->post_parent);
        $parent2 = get_post($parentname->post_parent);
        ?>
        <div class="content <?php echo $pagename ? $parent2 ? htmlspecialchars($parent2->post_name) : htmlspecialchars($pagename)  : 'home' ?>">
