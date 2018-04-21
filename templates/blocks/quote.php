<?php

function quote($layout, $i) {
  $background     = get_sub_field('background');
  $quote          = get_sub_field('quote');
  $attribution    = get_sub_field('attribution');

  echo '<section class="text quote '.$background.'">';
    headline($layout, $i);
    echo '<article>';
      echo '<div class="full">';
        echo '<blockquote>';
        echo '<i class="fas fa-comments"></i>';
        if($quote) { echo $quote; }
        if($attribution) { echo '<h4>'.$attribution.'</h4>'; }
        echo '</blockquote>';
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
