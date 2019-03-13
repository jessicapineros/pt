<?php
/**
 * puretrade functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link http://codex.wordpress.org/Theme_Development
 * @link http://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * @link http://codex.wordpress.org/Plugin_API
 *
 * @package WordPress
 * @subpackage puretrade
 * @since puretrade 1.0
 */
/**
 * Set up the content width value based on the theme's design.
 *
 * @see puretrade_content_width()
 *
 * @since puretrade 1.0
 */


if (!isset($content_width)) {
  $content_width = 474;
}

/**
 * puretrade only works in WordPress 3.6 or later.
 */
if (version_compare($GLOBALS['wp_version'], '3.6', '<')) {
  require get_template_directory() . '/inc/back-compat.php';
}

if (!function_exists('puretrade_setup')) :

  /**
   * puretrade setup.
   *
   * Set up theme defaults and registers support for various WordPress features.
   *
   * Note that this function is hooked into the after_setup_theme hook, which
   * runs before the init hook. The init hook is too late for some features, such
   * as indicating support post thumbnails.
   *
   * @since puretrade 1.0
   */
  function puretrade_setup() {

    /*
     * Make puretrade available for translation.
     *
     * Translations can be added to the /languages/ directory.
     * If you're building a theme based on puretrade, use a find and
     * replace to change 'puretrade' to the name of your theme in all
     * template files.
     */
    load_theme_textdomain('puretrade', get_template_directory() . '/languages');

    // This theme styles the visual editor to resemble the theme style.
    add_editor_style(array('css/editor-style.css', puretrade_font_url()));

    // Add RSS feed links to <head> for posts and comments.
    add_theme_support('automatic-feed-links');

    // Enable support for Post Thumbnails, and declare two sizes.
    add_theme_support('post-thumbnails');
    set_post_thumbnail_size(672, 372, true);
    add_image_size('puretrade-full-width', 1038, 576, true);

    // This theme uses wp_nav_menu() in two locations.
    register_nav_menus(array(
        'primary' => __('Top primary menu', 'puretrade'),
        'secondary' => __('Secondary menu in left sidebar', 'puretrade'),
        'espace-client-submenu' => __('Espace client submenu', 'puretrade'),
        'footer-menu2' => __('Espace client footer2', 'puretrade')
    ));

    /*
     * Switch default core markup for search form, comment form, and comments
     * to output valid HTML5.
     */
    add_theme_support('html5', array(
        'search-form', 'comment-form', 'comment-list',
    ));

    /*
     * Enable support for Post Formats.
     * See http://codex.wordpress.org/Post_Formats
     */
    add_theme_support('post-formats', array(
        'aside', 'image', 'video', 'audio', 'quote', 'link', 'gallery',
    ));

    // This theme allows users to set a custom background.
    add_theme_support('custom-background', apply_filters('puretrade_custom_background_args', array(
                'default-color' => 'f5f5f5',
            )));

    // Add support for featured content.
    add_theme_support('featured-content', array(
        'featured_content_filter' => 'puretrade_get_featured_posts',
        'max_posts' => 6,
    ));

    // This theme uses its own gallery styles.
    add_filter('use_default_gallery_style', '__return_false');
  }

endif; // puretrade_setup
add_action('after_setup_theme', 'puretrade_setup');

/**
 * Adjust content_width value for image attachment template.
 *
 * @since puretrade 1.0
 *
 * @return void
 */
function puretrade_content_width() {
  if (is_attachment() && wp_attachment_is_image()) {
    $GLOBALS['content_width'] = 810;
  }
}

add_action('template_redirect', 'puretrade_content_width');

/**
 * Getter function for Featured Content Plugin.
 *
 * @since puretrade 1.0
 *
 * @return array An array of WP_Post objects.
 */
function puretrade_get_featured_posts() {
  /**
   * Filter the featured posts to return in puretrade.
   *
   * @since puretrade 1.0
   *
   * @param array|bool $posts Array of featured posts, otherwise false.
   */
  return apply_filters('puretrade_get_featured_posts', array());
}

/**
 * A helper conditional function that returns a boolean value.
 *
 * @since puretrade 1.0
 *
 * @return bool Whether there are featured posts.
 */
function puretrade_has_featured_posts() {
  return !is_paged() && (bool) puretrade_get_featured_posts();
}

/**
 * Register three puretrade widget areas.
 *
 * @since puretrade 1.0
 *
 * @return void
 */
function puretrade_widgets_init() {
  require get_template_directory() . '/inc/widgets.php';
  register_widget('puretrade_Ephemera_Widget');

  register_sidebar(array(
      'name' => __('Primary Sidebar', 'puretrade'),
      'id' => 'sidebar-1',
      'description' => __('Main sidebar that appears on the left.', 'puretrade'),
      'before_widget' => '<aside id="%1$s" class="widget %2$s">',
      'after_widget' => '</aside>',
      'before_title' => '<h1 class="widget-title">',
      'after_title' => '</h1>',
  ));
  register_sidebar(array(
      'name' => __('Content Sidebar', 'puretrade'),
      'id' => 'sidebar-2',
      'description' => __('Additional sidebar that appears on the right.', 'puretrade'),
      'before_widget' => '<aside id="%1$s" class="widget %2$s">',
      'after_widget' => '</aside>',
      'before_title' => '<h1 class="widget-title">',
      'after_title' => '</h1>',
  ));
  register_sidebar(array(
      'name' => __('Footer Widget Area', 'puretrade'),
      'id' => 'sidebar-3',
      'description' => __('Appears in the footer section of the site.', 'puretrade'),
      'before_widget' => '<aside id="%1$s" class="widget %2$s">',
      'after_widget' => '</aside>',
      'before_title' => '<h1 class="widget-title">',
      'after_title' => '</h1>',
  ));
}

add_action('widgets_init', 'puretrade_widgets_init');

/**
 * Register Lato Google font for puretrade.
 *
 * @since puretrade 1.0
 *
 * @return string
 */
function puretrade_font_url() {
  $font_url = '';
  /*
   * Translators: If there are characters in your language that are not supported
   * by Lato, translate this to 'off'. Do not translate into your own language.
   */
  if ('off' !== _x('on', 'Lato font: on or off', 'puretrade')) {
    $font_url = add_query_arg('family', urlencode('Lato:300,400,700,900,300italic,400italic,700italic'), "//fonts.googleapis.com/css");
  }

  return $font_url;
}

/**
 * Enqueue scripts and styles for the front end.
 *
 * @since puretrade 1.0
 *
 * @return void
 */
function puretrade_scripts() {

  $cssVersion = date('Y m d H i s');
  // Add Lato font, used in the main stylesheet.
  wp_enqueue_style('puretrade-lato', puretrade_font_url(), array(), null);

  // Add Genericons font, used in the main stylesheet.
  wp_enqueue_style('genericons', get_template_directory_uri() . '/genericons/genericons.css', array(), '3.0.2');

  // Load our main stylesheet.
  wp_enqueue_style('puretrade-style', get_stylesheet_uri(), array('genericons'), $cssVersion);

  // Load the Internet Explorer specific stylesheet.
  wp_enqueue_style('puretrade-ie', get_template_directory_uri() . '/css/ie.css', array('puretrade-style', 'genericons'), '20131205');
  wp_style_add_data('puretrade-ie', 'conditional', 'lt IE 9');

  //peexeo ---- add space-client.css
  wp_enqueue_style('espace-client', get_template_directory_uri() . '/css/espace-client.css', array(), null);
  //peexeo ---- add lightbox.css
  wp_enqueue_style('lightbox', get_template_directory_uri() . '/css/lightbox.css', array(), null);
  //peexeo

  if (is_singular() && comments_open() && get_option('thread_comments')) {
    wp_enqueue_script('comment-reply');
  }

  if (is_singular() && wp_attachment_is_image()) {
    wp_enqueue_script('puretrade-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array('jquery'), '20130402');
  }

  if (is_active_sidebar('sidebar-3')) {
    wp_enqueue_script('jquery-masonry');
  }

  if (is_front_page() && 'slider' == get_theme_mod('featured_content_layout')) {
    wp_enqueue_script('puretrade-slider', get_template_directory_uri() . '/js/slider.js', array('jquery'), '20131205', true);
    wp_localize_script('puretrade-slider', 'featuredSliderDefaults', array(
        'prevText' => __('Previous', 'puretrade'),
        'nextText' => __('Next', 'puretrade')
    ));
  }

  wp_enqueue_script('puretrade-script', get_template_directory_uri() . '/js/functions.js', array('jquery'), '20131209', true);
  //peexeo ---- add lightbox.js
  wp_enqueue_script('lightbox', get_template_directory_uri().'/js/lightbox.js', array('jquery'), '20180502', true);
  //peexeo
}

add_action('wp_enqueue_scripts', 'puretrade_scripts');

/**
 * Enqueue Google fonts style to admin screen for custom header display.
 *
 * @since puretrade 1.0
 *
 * @return void
 */
function puretrade_admin_fonts() {
  wp_enqueue_style('puretrade-lato', puretrade_font_url(), array(), null);
}

add_action('admin_print_scripts-appearance_page_custom-header', 'puretrade_admin_fonts');

if (!function_exists('puretrade_the_attached_image')) :

  /**
   * Print the attached image with a link to the next attached image.
   *
   * @since puretrade 1.0
   *
   * @return void
   */
  function puretrade_the_attached_image() {
    $post = get_post();
    /**
     * Filter the default puretrade attachment size.
     *
     * @since puretrade 1.0
     *
     * @param array $dimensions {
     *     An array of height and width dimensions.
     *
     *     @type int $height Height of the image in pixels. Default 810.
     *     @type int $width  Width of the image in pixels. Default 810.
     * }
     */
    $attachment_size = apply_filters('puretrade_attachment_size', array(810, 810));
    $next_attachment_url = wp_get_attachment_url();

    /*
     * Grab the IDs of all the image attachments in a gallery so we can get the URL
     * of the next adjacent image in a gallery, or the first image (if we're
     * looking at the last image in a gallery), or, in a gallery of one, just the
     * link to that image file.
     */
    $attachment_ids = get_posts(array(
        'post_parent' => $post->post_parent,
        'fields' => 'ids',
        'numberposts' => -1,
        'post_status' => 'inherit',
        'post_type' => 'attachment',
        'post_mime_type' => 'image',
        'order' => 'ASC',
        'orderby' => 'menu_order ID',
            ));

    // If there is more than 1 attachment in a gallery...
    if (count($attachment_ids) > 1) {
      foreach ($attachment_ids as $attachment_id) {
        if ($attachment_id == $post->ID) {
          $next_id = current($attachment_ids);
          break;
        }
      }

      // get the URL of the next image attachment...
      if ($next_id) {
        $next_attachment_url = get_attachment_link($next_id);
      }

      // or get the URL of the first image attachment.
      else {
        $next_attachment_url = get_attachment_link(array_shift($attachment_ids));
      }
    }

    printf('<a href="%1$s" rel="attachment">%2$s</a>', esc_url($next_attachment_url), wp_get_attachment_image($post->ID, $attachment_size)
    );
  }

endif;

if (!function_exists('puretrade_list_authors')) :

  /**
   * Print a list of all site contributors who published at least one post.
   *
   * @since puretrade 1.0
   *
   * @return void
   */
  function puretrade_list_authors() {
    $contributor_ids = get_users(array(
        'fields' => 'ID',
        'orderby' => 'post_count',
        'order' => 'DESC',
        'who' => 'authors',
            ));

    foreach ($contributor_ids as $contributor_id) :
      $post_count = count_user_posts($contributor_id);

      // Move on if user has not published a post (yet).
      if (!$post_count) {
        continue;
      }
      ?>

      <div class="contributor">
      		<div class="contributor-info">
          <div class="contributor-avatar"><?php echo get_avatar($contributor_id, 132); ?></div>
          <div class="contributor-summary">
            <h2 class="contributor-name"><?php echo get_the_author_meta('display_name', $contributor_id); ?></h2>
            <p class="contributor-bio">
      <?php echo get_the_author_meta('description', $contributor_id); ?>
            </p>
            <a class="contributor-posts-link" href="<?php echo esc_url(get_author_posts_url($contributor_id)); ?>">
      <?php printf(_n('%d Article', '%d Articles', $post_count, 'puretrade'), $post_count); ?>
            </a>
          </div><!-- .contributor-summary -->
      		</div><!-- .contributor-info -->
      </div><!-- .contributor -->

      <?php
    endforeach;
  }

endif;

/**
 * Extend the default WordPress body classes.
 *
 * Adds body classes to denote:
 * 1. Single or multiple authors.
 * 2. Presence of header image.
 * 3. Index views.
 * 4. Full-width content layout.
 * 5. Presence of footer widgets.
 * 6. Single views.
 * 7. Featured content layout.
 *
 * @since puretrade 1.0
 *
 * @param array $classes A list of existing body class values.
 * @return array The filtered body class list.
 */
function puretrade_body_classes($classes) {
  if (is_multi_author()) {
    $classes[] = 'group-blog';
  }

  if (get_header_image()) {
    $classes[] = 'header-image';
  } else {
    $classes[] = 'masthead-fixed';
  }

  if (is_archive() || is_search() || is_home()) {
    $classes[] = 'list-view';
  }

  if ((!is_active_sidebar('sidebar-2') )
          || is_page_template('page-templates/full-width.php')
          || is_page_template('page-templates/contributors.php')
          || is_attachment()) {
    $classes[] = 'full-width';
  }

  if (is_active_sidebar('sidebar-3')) {
    $classes[] = 'footer-widgets';
  }

  if (is_singular() && !is_front_page()) {
    $classes[] = 'singular';
  }

  if (is_front_page() && 'slider' == get_theme_mod('featured_content_layout')) {
    $classes[] = 'slider';
  } elseif (is_front_page()) {
    $classes[] = 'grid';
  }

  return $classes;
}

add_filter('body_class', 'puretrade_body_classes');

/**
 * Extend the default WordPress post classes.
 *
 * Adds a post class to denote:
 * Non-password protected page with a post thumbnail.
 *
 * @since puretrade 1.0
 *
 * @param array $classes A list of existing post class values.
 * @return array The filtered post class list.
 */
function puretrade_post_classes($classes) {
  if (!post_password_required() && has_post_thumbnail()) {
    $classes[] = 'has-post-thumbnail';
  }

  return $classes;
}

add_filter('post_class', 'puretrade_post_classes');

/**
 * Create a nicely formatted and more specific title element text for output
 * in head of document, based on current view.
 *
 * @since puretrade 1.0
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string The filtered title.
 */
function puretrade_wp_title($title, $sep) {
  global $paged, $page;

  if (is_feed()) {
    return $title;
  }

  // Add the site name.
  $title .= get_bloginfo('name');

  // Add the site description for the home/front page.
  $site_description = get_bloginfo('description', 'display');
  if ($site_description && ( is_home() || is_front_page() )) {
    $title = "$title $sep $site_description";
  }

  // Add a page number if necessary.
  if ($paged >= 2 || $page >= 2) {
    $title = "$title $sep " . sprintf(__('Page %s', 'puretrade'), max($paged, $page));
  }

  return $title;
}

add_filter('wp_title', 'puretrade_wp_title', 10, 2);

// Implement Custom Header features.
require get_template_directory() . '/inc/custom-header.php';

// Custom template tags for this theme.
require get_template_directory() . '/inc/template-tags.php';

// Add Theme Customizer functionality.
require get_template_directory() . '/inc/customizer.php';

/*
 * Add Featured Content functionality.
 *
 * To overwrite in a plugin, define your own Featured_Content class on or
 * before the 'setup_theme' hook.
 */
if (!class_exists('Featured_Content') && 'plugins.php' !== $GLOBALS['pagenow']) {
  require get_template_directory() . '/inc/featured-content.php';
}

function custom_excerpt_length($length) {
  return 20;
}

add_filter('excerpt_length', 'custom_excerpt_length', 999);

function new_excerpt_more($more) {
  return '...';
}

add_filter('excerpt_more', 'new_excerpt_more');

//Remove editor option from appearencetab
define( 'DISALLOW_FILE_EDIT', true );

//Customize logo
function my_custom_login_logo() {
    echo '<style type="text/css">
        .login h1 a {
          width: 137px !important;
          height: 84px !important;
          background-image:url('.get_bloginfo('template_directory').'/images/logo.png) !important;
          background-size: 100% auto;
        }
    </style>';
}

add_action('login_head', 'my_custom_login_logo');

function st_welcome_panel() {
echo
'<div class="welcome-panel-content">'
.'<h3>Your Welcome Title</h3>'
.'<iframe src="//www.youtube.com/embed/BirQTaTPYwA" height="480" width="854" allowfullscreen="" frameborder="0"></iframe>'
.'</div>';

echo
'<div class="welcome-panel-content">'
.'<h3>Add new slide or step to slider </h3>'
.'<iframe src="//www.youtube.com/embed/ILQWP7nphRk" height="480" width="854" allowfullscreen="" frameborder="0"></iframe>'
.'</div>';

echo
'<div class="welcome-panel-content">'
.'<h3>Add an accordion or post</h3>'
.'<iframe src="//www.youtube.com/embed/xp1o17xX058" height="480" width="854" allowfullscreen="" frameborder="0"></iframe>'
.'</div>';

echo
'<div class="welcome-panel-content">'
.'<h3>Create and add edit to Home Slider </h3>'
.'<iframe src="//www.youtube.com/embed/A4GjHhwqlmw?list=PLTTwxXTevF_FPQKv9c1SPJmDeR-VdYTFr" height="480" width="854" allowfullscreen="" frameborder="0"></iframe>'
.'</div>';

echo
'<div class="welcome-panel-content">'
.'<h3>Create Post for Contact page</h3>'
.'<iframe src="//www.youtube.com/embed/U6zq5_nQzD0?list=PLTTwxXTevF_FPQKv9c1SPJmDeR-VdYTFr" height="480" width="854" allowfullscreen="" frameborder="0"></iframe>'
.'</div>';

echo
'<div class="welcome-panel-content">'
.'<h3>Create Post for News Page</h3>'
.'<iframe src="//www.youtube.com/embed/rM8yrgwE9r4?list=PLTTwxXTevF_FPQKv9c1SPJmDeR-VdYTFr" height="480" width="854" allowfullscreen="" frameborder="0"></iframe>'
.'</div>';

echo
'<div class="welcome-panel-content">'
.'<h3>Create new page and post</h3>'
.'<iframe src="//www.youtube.com/embed/Udzo1srxITI" height="480" width="854" allowfullscreen="" frameborder="0"></iframe>'
.'</div>';
}

remove_action('welcome_panel','wp_welcome_panel');
add_action('welcome_panel','st_welcome_panel');



//--------- Peexeo ------------------------------------

//custom post type
require_once( 'custom-post-type.php' );

//admin bar
add_filter('show_admin_bar', '__return_false');


// Add a custom user role // https://blogpascher.com/tutoriel-wordpress/comment-creer-des-roles-dutilisateurs-sur-wordpress
/*
$result = add_role( 'test', __('Test' ),
array(
      'read' => true, // active cette capacité de lecture
      'edit_posts' => true , // Permet à l' utilisateur de modifier ses propres articles
      'edit_pages' => true , // Permet à l' utilisateur d'éditer des pages
      'edit_others_posts' => true , // Permet à l' utilisateur d'éditer d'autres articles pas seulement les siens
      'create_posts' => true , // Permet à l' utilisateur de créer de nouveaux articles
      'manage_categories' => true , // Permet à l' utilisateur de gérer les catégories des articles
      'publish_posts' => true , // Permet à l'utilisateur de publier, sinon les messages reste en mode brouillon
      'edit_themes' => false , // L' utilisateur ne peut pas modifier un thème
      'install_plugins' => false , // L' utilisateur ne peut pas ajouter de nouveaux plugins
      'update_plugin' => false , // L'utilisateur ne peut pas mettre à jour les plugins
      'update_core' => false // l’utilisateur ne peut pas effectuer des mises à jour de WordPress
  )
);
//delete user role
if( get_role('test') ){
      remove_role( 'test' );
}
*/


// login -password
// Ajouter le lien pour récupérer le mot de passe, si l'utilisateur ne s'en souvient plus
function lost_password_link( $formbottom ) {
	$formbottom .= '<a class="forgot-password" href="' . wp_lostpassword_url() . '">Forgot password?</a>';
	return $formbottom;
}
add_filter( 'login_form_bottom', 'lost_password_link' );

/*

//pagination
// navigation page press
// src: http://www.sweet-web-design.com/wordpress/how-to-add-an-anchor-link-to-wordpress-pagination/2781/
//&lsaquo; &rsaquo;
function bones_page_navi_press() {
  global $wp_query;

  $bignum = 999999999;
  if ( $wp_query->max_num_pages <= 1 )
    return;
  echo '<nav class="pagination">';
  echo paginate_links( array(
    'base'         => str_replace( $bignum, '%#%#press_block', esc_url( get_pagenum_link($bignum) ) ),
    'format'       => '?paged=%#%',
    'current'      => max( 1, get_query_var('paged') ),
    'total'        => $wp_query->max_num_pages,
    'prev_text'    => '<span class="left">Previous page</span>',
    'next_text'    => '<span class="right">Next page</span>',
    'type'         => 'plain',
    'end_size'     => 3,
    'mid_size'     => 3
  ) );
  echo '</nav>';
}

*/

// Numeric Page Navi (built into the theme by default)
function bones_page_navi() {
  global $wp_query;

  $bignum = 999999999;
  if ( $wp_query->max_num_pages <= 1 )
    return;
  echo '<nav class="pagination">';
  echo paginate_links( array(
    'base'         => str_replace( $bignum, '%#%', esc_url( get_pagenum_link($bignum) ) ),
    'format'       => '',
    'current'      => max( 1, get_query_var('paged') ),
    'total'        => $wp_query->max_num_pages,
    'prev_text'    => '<span class="left">Previous page</span>',
    'next_text'    => '<span class="right">Next page</span>',
    'type'         => 'plain',
    'end_size'     => 3,
    'mid_size'     => 3
  ) );
  echo '</nav>';

} /* end page navi */

//custom post type pagination
//https://wpsites.net/wordpress-tips/add-pagination-to-custom-post-type-archive-pages/
add_action( 'pre_get_posts', 'wpsites_cpt_archive_items' );
function wpsites_cpt_archive_items( $query ) {
if( $query->is_main_query() && !is_admin() && is_post_type_archive( 'actualites' ) ) {
		$query->set( 'posts_per_page', '4' );
	}
}



//style login page wp - this change style-login.css
//http://codex.wordpress.org/Plugin_API/Action_Reference/login_enqueue_scripts
function puretrade_login_css() {
	wp_enqueue_style( 'puretrade_login_css', get_template_directory_uri() . '/css/login.css', false );
}
// changing the logo link from wordpress.org to your site
function puretrade_login_url() {  return home_url(); }

// changing the alt text on the logo to show your site name
function puretrade_login_title() { return get_option( 'puretrade' ); }

// calling it only on the login page
add_action( 'login_enqueue_scripts', 'puretrade_login_css', 10 );
add_filter( 'login_headerurl', 'puretrade_login_url' );
add_filter( 'login_headertitle', 'puretrade_login_title' );
