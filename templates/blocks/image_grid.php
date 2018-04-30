<?php

function image_grid($layout, $i) {
  $background     = get_sub_field('background');
  $images_per_row = get_sub_field('images_per_row');
  $grid_images    = get_sub_field('grid_images');
  $full_width     = get_sub_field('full_width');
  $class = array(); // set up classes
  $class[2] = "half";
  $class[3] = "third";
  $class[4] = "fourth";
  $width = "";
  if($full_width) { $width = 'full_width'; }
  echo '<section class="image_grid images_'.$images_per_row.' '.$background.' '.$width.'">';
    headline($layout, $i);
    echo '<article>';
      if($grid_images) {
        $i = 0;
        foreach ($grid_images as $item) {
          echo '<div class="'.$class[$images_per_row].'">';

            if($item['link']) { echo '<a class="image" href="'.$item['link'].'">';  }
            else { echo '<a class="image lightbox" target="_blank" href="'.$item['photo']['url'].'" data-caption="'.$item['headline'].' // '.$item['copy'].'">';  }
              echo '<img src="'.$item['photo']['sizes']['medium'].'" alt="'.$item['photo']['alt'].'" />';

              echo '<span class="sr">'.$item['headline'].'</span>';
            echo '</a>';
            echo '<div class="image_description">';
              if ($item['headline']) { echo '<h4>'.$item['headline'].'</h4>'; }
              if ($item['copy']) { echo '<p>'.$item['copy'].'</p>'; }
            echo '</div>';
            if ($full_width && $item['link']) {
              echo '<a class="link_cover" href="'.$item['link'].'">';
                echo '<span class="sr">'.$item['headline'].'</span>';
              echo '</a>';
            }
          echo '</div>';
          $i++;
          if ($i == $images_per_row) {
            $i = 0;
            echo '</article><article>';
          }
        }
      }
    echo '</article>';
  echo '</section>';
}
