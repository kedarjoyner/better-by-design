<?php

function locations($layout, $i) {
  echo '<section class="locations white" data-map="map-'.$i.'" >';
    headline($layout, $i);
    echo '<div class="dynamic-map map-'.$i.'" data-map="map-'.$i.'" ></div>';
    echo '<article>';
      echo '<div class="full">';
        $locations = get_locations(get_sub_field('populate'));
        get_filters(get_sub_field('filtering'));
        display_locations($locations);
      echo '</div>';
    echo '</article>';
  echo '</section>';
}
