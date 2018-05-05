
    <footer>
      <?php
      $background = get_field('footer_background', 'options');
      echo '<section  class="footer '.$background.'">';
        echo '<div class="full">';

          $logo = get_field('footer_logo', 'options');

          if ($logo) {
            echo '<div class="footer-logo">';
              echo '<img src="'.$logo.'"/>';
            echo '</div>';
          }
          
          social_media('p', 'options');
          echo '<nav class="footer">';
          $footer_menu = array('theme_location' => 'footer-menu', 'container' => ' ', 'items_wrap' => '%3$s' );
          wp_nav_menu($footer_menu);
          echo '</nav>';

          echo '<article class="information" itemscope itemtype="http://schema.org/LocalBusiness">';
            get_copyright('p', 'options');
            get_address('p', 'options');
            get_phone('p', 'options');
            get_email('p', 'options');
          echo '</article>';
        echo '</div>';
        if( $background === 'image') {
          $color       = get_field('footer_overlay', 'options');
        	$opacity     = get_field('footer_overlay_opacity', 'options');
          $image       = get_field('footer_image', 'options');
        	$class       = 'background_image overlay '.$color.' opacity_'.$opacity;
        	$style       = 'background-image: url('.$image['sizes']['large'].')';
        	echo '<div class="'.$class.'" style="'.$style.'"></div>';
        }
      echo '</main>';

      ?>
    </footer>
  </div> <!-- /page -->
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAxFxKWjL_UYbZmZUiYcYeXmu-4ZBlFUy8"></script>
  <script src="<?php theme(); ?>/javascript/min/plugins-min.js"></script>
  <script src="<?php theme(); ?>/javascript/dirigible.js"></script>
  <?php wp_footer(); ?>
</body>
</html>
