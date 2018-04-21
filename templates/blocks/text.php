<?php

function text($layout, $i) {
  $background = get_sub_field('background');
  $columns    = get_sub_field('columns');
  $content    = get_sub_field('content');
  echo '<section class="text '.$background.' '.$columns.'">';
    headline($layout, $i);
    echo '<article>';
      echo '<div class="full">';
        if( $content ){ echo $content ;}
      echo '</div>';
    echo '</article>';
    if( $background === 'image') {
      $color    = get_sub_field('overlay');
    	$opacity  = get_sub_field('overlay_opacity');
      $image    = get_sub_field('image');
    	$class    = 'background_image overlay '.$color.' opacity_'.$opacity;
    	$style    = 'background-image: url('.$image['sizes']['large'].');';
      echo '<div class="'.$class.'" style="'.$style.'"></div>';
    }
  echo '</section>';
}
