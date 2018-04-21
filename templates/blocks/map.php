<?php

function map($layout, $i) {
  $location = get_sub_field('location');
  echo '<section class="map_block">';
    headline($layout, $i);
    echo '<div class="map_location acf-map">';
      echo '<div class="marker" data-lat="'.$location['lat'].'" data-lng="'.$location['lng'].'"></div>';
    echo '</div>';
  echo '</section>';
}
