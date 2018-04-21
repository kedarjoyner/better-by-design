<?php

function recent_posts($layout, $i) {
  $background      = get_sub_field('background');
  $number          = get_sub_field('number_of_posts');
  $categories      = get_sub_field('category');
  $category_string = "";
  if($categories) {
    foreach ($categories as $cat) {
       $category_string .= $cat.',';
    }
  }
  echo '<section class="recent_posts_block '.$background.'">';
    headline($layout, $i);
    echo '<article>';
      echo '<div class="full summaries">';
        echo '<div class="packery">';
        query_posts( 'cat='.$category_string.'&posts_per_page='.$number );
        $index = 0;
        while ( have_posts() ) : the_post();
          print_card('pack');
          $index++;
        endwhile;
        wp_reset_query();
        echo '</div>';
      echo '</div>';
    echo '</article>';
  echo '</section>';
}
