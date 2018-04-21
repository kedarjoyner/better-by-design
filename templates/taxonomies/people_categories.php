<?php

$i = 0;
echo '<section class="people white">';
  echo '<article>';
		echo '<div class="full">';
    $people = get_people('taxonomy');
    if($people) {
      if(count($people) > 2) {
        echo '<div class="people_container">';
      }
      else {
        echo '<div class="people_container_center">';
      }
      foreach ($people as $person) {
        $id = $person;
        $name = get_the_title($person);
        $link = get_the_permalink($person);
        $job = get_field('job_title', $person);
        $bio = get_field('biography_excerpt', $person);
        $headshot = get_field('headshot', $person);
        $terms = get_the_terms($id, 'people_categories');
        $class = "show_all ";
        foreach ($terms as $term) { $class .= $term->slug." "; }
        echo '<div class="person '.$class.'">';
          if($headshot) {
            echo '<div class="headshot">';
              echo '<img src="'.$headshot['sizes']['thumbnail'].'" alt="'.$headshot['alt'].'"/>';
            echo '</div>';
          }
          else {
            echo '<div class="headshot empty">';
              echo '<i class="fas fa-user"></i>';
            echo '</div>';
          }
          echo '<h3>'.$name.'</h3>';
          if($job) { echo '<h4>'.$job.'</h4>'; }
          if($bio) { echo $bio; }
          echo '<a class="person_link" href="'.$link.'"><span class="sr">'.$name.'</span></a>';
        echo '</div>';
      }
      echo '</div>';
    }
  echo '</div></article>'; 
echo '</section>';


?>
