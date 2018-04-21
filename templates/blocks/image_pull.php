<?php

function image_pull($layout, $i) {
  $single_photo   = get_sub_field('single_photo');
  $content        = get_sub_field('content');
  $position       = get_sub_field('copy_align');
  echo '<section class="image_pull copy_align_'.$position.'">';
    headline($layout, $i);
    echo '<div class="single_image"  style="background-image: url('.$single_photo['sizes']['large'].'); "></div>';
    echo '<div class="image_content">';
      echo $content;
    echo '</div>';
  echo '</section>';
}
