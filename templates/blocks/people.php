<?php

function people($layout, $i) {
  $background  = get_sub_field('background');
  $full_width  = get_sub_field('full_width');
  $populate_by = get_sub_field('populate_by');
  $filtering   = get_sub_field('filtering');

  echo '<section class="people '.$background.' ">';
    headline($layout, $i);
    if(!$full_width) { echo '<article><div class="full">'; }
    else { echo '<div class="full_width_people">'; }
      if($filtering === "enabled") {
        echo '<ul class="people_filter">';
          $filter_cats = get_sub_field('filter_categories');
          echo '<li data-filter=".show_all" class="active">Show All</li>';
          foreach ($filter_cats as $filter) {
            $term = get_term( $filter, 'people_categories' );
            echo '<li data-filter=".'.$term->slug.'">'.$term->name.'</li>';
          }
        echo '</ul>';
      }
      $people = get_people($populate_by);
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
    if(!$full_width) { echo '</div></article>'; }
    else { echo '</div>'; }
  echo '</section>';
}
