<?php

function half_page($layout, $i) {
  $background     = get_sub_field('background');
  $left_block     = get_sub_field('left_block');
  $right_block    = get_sub_field('right_block');
  echo '<section class="half_page text '.$background.'">';
    headline($layout, $i);
    echo '<article>';
      echo '<div class="half">'.$left_block.'</div>';
      echo '<div class="half">'.$right_block.'</div>';

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
