

<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @subpackage puretrade
 * @since puretrade 1.0
 */
?>
</div>
</div>
</div>
<footer class="cf footer2">
  <div class="footer-logo">
    <?php
    wp_reset_query();
    wp_nav_menu(array('theme_location' => 'footer-menu2', 'container' => '', 'menu_class' => 'footer-menu'));
    ?>
  </div>
  <div class="social-links">
    <?php the_field('social_icon', 5); ?>
  </div>
</footer>


<script src="<?php echo get_template_directory_uri(); ?>/js/vendor/jquery.boutique.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/script.js" defer="defer"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/lightbox-scroll.js"></script>
<?php wp_footer(); ?>
</body>
</html>
