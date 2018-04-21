<?php

function gallery($layout, $i) {
  $background = get_sub_field('background');
  $full_width = get_sub_field('full_width');
  $content    = get_sub_field('content');
  $photos     = get_sub_field('photos');
  echo '<section class="gallery '.$background.'">';
    headline($layout, $i);
    if(!$full_width) { echo '<article><div class="full">'; }
        if( $content ){
          echo '<div class="gallery_content">';
            echo $content;
          echo '</div>';
        }
        if( $photos ) { dirigible_gallery($photos);  }
    if(!$full_width) { echo '</div></article>'; }
  echo '</section>';
}
