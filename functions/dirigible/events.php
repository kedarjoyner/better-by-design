<?php

function event_preview() {
  $title       = get_the_title();
  $date        = DateTime::createFromFormat('YmdHis', get_field('date'));
  $description = get_field('short_description');
  $venue       = get_field('venue');
  $multi_day   = get_field('multi-day');
  $end_date    = DateTime::createFromFormat('YmdHis', get_field('end_date'));
  $image       = get_field('image');

  echo '<div class="event_preview">';
    echo '<div class="date_badge">';
      $month = $date->format('M');
      $day = $date->format('j');
      echo '<span class="day">'.$day.'</span>';
      echo '<span class="month">'.$month.'</span>';
    echo '</div>';
    echo '<div class="description">';
      if($description) {
        echo '<h3>'.$title.'</h3>';
        echo '<p>'.$description.'</p>';
      }
      echo '<ul class="information">';
        if($date) {
          echo '<li>';
            echo '<i class="fas fa-fw fa-calendar" data-fa-transform="up-1 left-8"></i> '.$date->format('M jS');
            if($multi_day && $end_date) { echo ' - '.$end_date->format('M jS');  }
          echo '</li>';
          echo '<li><i class="fas fa-fw fa-clock" data-fa-transform="up-1 left-8"></i> '.$date->format('g:i a').'</li>';
        }
        if($venue) {
          echo '<li><i class="fas fa-fw fa-map" data-fa-transform="up-1 left-8"></i> '.$venue.'</li>';
        }
      echo '</ul>';
    echo '</div>';
    echo '<a class="event_overlay" href="'.get_the_permalink().'"><span class="sr">'.get_the_title().'<span></a>';
  echo '</div>';
}
