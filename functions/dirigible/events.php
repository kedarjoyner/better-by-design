<?php


function event_preview() {
  $title       = get_the_title();
  $date        = DateTime::createFromFormat('YmdHis', get_field('date'));
  $year        = $date->format('Y');
  $description = get_field('short_description');
  $venue       = get_field('venue');
  $multi_day   = get_field('multi-day');
  $end_date    = DateTime::createFromFormat('YmdHis', get_field('end_date'));
  $image       = get_field('image');

  $event_speakers     = get_field('event_speakers');

  echo '<div class="event_preview">';

    echo '<div class="description">';
      if($description) {
        echo '<h3>'.$title.'</h3>';
        echo '<p>'.$description.'</p>';
      }
      echo '<ul class="information">';

        if($date) {
          // Year
          echo '<li>';
            echo $date->format('Y');
          echo '</li>'; 

          // Calendar day(s)
          echo '<li>';
            echo '<i class="fas fa-fw fa-calendar" data-fa-transform="up-1 left-8"></i> '.$date->format('M jS');
            if($multi_day && $end_date) { 
              echo ' - '.$end_date->format('M jS');  
            }
          echo '</li>';
          
          // Time
          echo '<li><i class="fas fa-fw fa-clock" data-fa-transform="up-1 left-8"></i> '.$date->format('g:i a').'</li>';
        }

      echo '</ul>';
    echo '</div>';

    if ( $event_speakers ) {
      echo '<div class="speakers half">';   
      // Loop through speakers
      foreach( $event_speakers as $post ) {

        // Makes global post equal to the speakers object
        setup_postdata( $post );

        echo '<div class="speakers-container">';

        $name 		= get_the_title($post->ID);
        $headshot = get_field('headshot', $post->ID);	 

        // Speaker image
        if($headshot) {
            echo '<div class="speaker-image">';
            echo '<img src="'.$headshot['sizes']['thumbnail'].'" alt="'.$headshot['alt'].'"/>';
            echo '</div>';
        } else {
          echo '<div class="speaker-image"><i class="fas fa-fw fa-user-circle"></i></div>';
        }

        echo '<div class="speaker-name">' . $name . '</div>';
        echo '</div>';
      }
      echo "</div>";

  wp_reset_postdata(); // reset post object to global post
}
    echo '<a class="event_overlay" href="'.get_the_permalink().'"><span class="sr">'.get_the_title().'<span></a>';
  echo '</div>';


  
}


