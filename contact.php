<?php
/**
 * The template for displaying all pages
 * Template name: contact
 *
 * @subpackage puretrade
 * @since puretrade 1.0
 */
get_header();
?>
<h2> <?php //the_title(); ?></h2> 
<section class="iframe-content">
  <?php
  $args = array('post_type' => 'post', 'category__and' => array(21), 'posts_per_page' => -1, 'orderby' => 'post_date', 'order' => 'ASC');
  query_posts($args);
  $count = 0;
  while (have_posts()): the_post();
    ?>
    <?php
    if ($count == 0) {
      echo '<div class="iframe-container"><iframe id="map-default" width="1024" height="394" frameborder="0" scrolling="no" class="map map-default" marginheight="0" marginwidth="0" src="' . get_field('location_url') . '"></iframe></div>';
      ?>
      <script>
        var iframeItem = 0,
        element = {},
        mapContent = {};
        element[iframeItem] ='<iframe id="map-'+iframeItem+'"width="1024" height="394" frameborder="0" scrolling="no" class="map map-0" marginheight="0" marginwidth="0" src="<?php the_field('location_url'); ?>"></iframe>';
        mapContent = element[iframeItem];
        iframeItem++;
      </script>
      <?php
    } else {
      ?>
      <script>
        element[iframeItem] ='<iframe id="map-'+iframeItem+'"width="1024" height="394" frameborder="0" scrolling="no" class="map map-0" marginheight="0" marginwidth="0" src="<?php the_field('location_url'); ?>"></iframe>';
        mapContent  = element[iframeItem] + mapContent
        iframeItem++;
      </script>
      <?php
    }
    if ($count%2==0) {
      $classname= 'even';
    }
    else {
      $classname= 'odd';
    }
    echo '<div class="location '. $classname .'"><h3>' . get_the_title() . '</h3><p class="map-icon" id="map-icon' . $count . '"><span style="background-image: url(' . get_field('location_icon', 44) . ')"></span><span class="view-map" id="view-map' . $count . '">' . get_field('location_text', 44) . '</span></p><div>';
    $count++;
    the_content();
    echo '</div></div>';
  endwhile;
  ?>
</section>
<script>
  (function($) {
    $('#map-default').load(function(){
      $('#map-default').css({
        'z-index': '1',
        'visibility': 'visible'
      }); 
      $('.iframe-content p.map-icon > span.view-map').click(function() {
        $(document).scrollTop(0);
        var b = $(this).attr('id').split('view-map')[1];
        $('.map').css({
          'z-index': '0',
          'visibility': 'hidden'
        });         
        $('#map-' + b).css({
          'z-index': '1',
          'visibility': 'visible'
        });
      });  
      $('.iframe-content .iframe-container').append(mapContent);
    });
  }(jQuery));
</script>
<?php get_footer(); ?>
