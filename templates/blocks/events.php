<?php

function events($layout, $i) {
  date_default_timezone_set('America/Chicago');
	$today      = date('YmdHis');
  $display    = get_sub_field('event_display');
  $category   = get_sub_field('category');
  $args = array(
    'post_type' => 'events',
    'post_status' => 'publish',
    'posts_per_page' => -1,
    'meta_query' => array(
        'relation' => 'OR',
        'end_date_clause' => array(
            'relation' => 'AND',
            array(
              'key' => 'end_date',
              'compare' => '>=',
              'value' => $today,
              'type' => 'DATETIME',
            ),
            array(
              'key' => 'multi-day',
              'compare' => '==',
              'value' => TRUE,
            ),
        ),
        'date_clause' => array(
            'key' => 'date',
            'compare' => '>=',
            'value' => $today,
            'type' => 'DATETIME',
        ),
    ),
    'orderby' => array(
        'date_clause' => 'ASC',
    )
  );
  switch ($display) {
    case 'upcoming': break;
    case 'past': $args['meta_compare'] = '<='; break;
    case 'category':
      $args['tax_query'] = array(
        'relation' => 'OR',
				array(
					'taxonomy' => 'event_categories',
					'field'    => 'term_id',
					'terms'    => $category,
				));
      break;
  }
  echo '<section class="event_block white">';
    headline($layout, $i);
    echo '<article>';
      echo '<div class="full">';
        $query = new WP_Query($args);
        while ($query->have_posts()) {
          $query->the_post();
          event_preview();
        }
        wp_reset_query();
      echo '</div>';
    echo '</article>';
  echo '</section>';
}
