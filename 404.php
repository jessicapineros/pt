<?php
/**
 * The template for displaying 404 pages (Not Found)
 *
 * @package WordPress
 * @subpackage puretrade
 * @since puretrade 1.0
 */
get_header();
?>
<div class="content page-not-found">
<h2><?php _e('page not found'); ?></h2>
<p><?php _e('<strong>Sorry This Page Does Not Exist.</strong>'); ?></p>
<p><?php _e('You seem to have clicked an expired link or mistyped the address. Please check the address or use one of the links below.'); ?></p>
<a class="read-more" href="<?php echo site_url(); ?>/">Return to home</a>
</div>
<?php
get_footer();
?>