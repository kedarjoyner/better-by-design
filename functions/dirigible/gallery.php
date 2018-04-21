<?php

 
function dirigible_gallery($images) {
  $counter = 1;
  echo '<div class="dirigible_gallery">';
  foreach( $images as $image ) {
      $mod = $counter % 10;
      switch ($mod) {
        case 1:
          if ($counter > 2) { echo '</ul>'; }
          echo '<ul class="dirigible_photo_gallery left" ><li class="large">'; break;
        case 2:  echo '<li class="small top left">'; break;
        case 3:  echo '<li class="small top right">'; break;
        case 4:  echo '<li class="small bottom left">'; break;
        case 5:  echo '<li class="small bottom right">'; break;
        case 6:  echo '</ul><ul class="dirigible_photo_gallery right"><li class="large">'; break;
        case 7:  echo '<li class="small top right">'; break;
        case 8:  echo '<li class="small top left">'; break;
        case 9:  echo '<li class="small bottom right">'; break;
        case 0:  echo '<li class="small bottom left">'; break;
        default:
      }
      echo '<a target="_blank" href="'.$image['sizes']['large'].'" alt="'.$image['alt'].'">';
          echo '<img src="'.$image['sizes']['medium'].'" alt="'.$image['alt'].'" data-caption="'.$image['caption'].'" />';
          echo '<i class="fas fa-image"></i>';
          echo '<p>HEY I AM A P</p>';
          echo '<span class="sr">'.$image['title'].'</span>';
      echo '</a>';
    echo '</li>';
    $counter++;
  }
  echo '</ul>';
  echo '</div>';
}
