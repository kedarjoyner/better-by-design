<?php

function get_people($populate_by) {
  $people = array();
  switch ($populate_by) {
    case 'custom': /***********************************************************/
      $people_field = get_sub_field('people');
      if($people_field) {
        foreach ($people_field as $person) {
          array_push($people, $person);
        }
      }
      break;
		case 'taxonomy': /********************************************************/
			$term = get_queried_object();
			$query = new WP_Query(array(
				'post_type' => 'people',
				'post_status' => 'publish',
				'posts_per_page' => -1,
				'orderby'  => 'wpse_last_word',
				'order' => 'ASC',
				'tax_query' => array(
					'relation' => 'OR',
					array (
						'taxonomy' => 'people_categories',
						'field' => 'term_id',
						'terms' => $term->term_id,
					)
				),
			));
			while ($query->have_posts()) {
        $query->the_post();
        array_push($people, get_the_id());
      }
      wp_reset_query();
			break;
    case 'category':  /********************************************************/
      $cats = get_sub_field('people_categories');
      $query = new WP_Query(array(
        'post_type' => 'people',
        'post_status' => 'publish',
        'posts_per_page' => -1,
        'orderby'  => 'wpse_last_word',
        'order' => 'ASC',
        'tax_query' => array(
          'relation' => 'OR',
          array (
            'taxonomy' => 'people_categories',
            'field' => 'term_id',
            'terms' => $cats,
          )
        ),
      ));
      while ($query->have_posts()) {
        $query->the_post();
        array_push($people, get_the_id());
      }
      wp_reset_query();
      break;
    case 'all':  /*************************************************************/
      $query = new WP_Query(array(
        'post_type' => 'people',
        'post_status' => 'publish',
        'posts_per_page' => -1,
        'orderby'  => 'wpse_last_word',
        'order' => 'ASC',
      ));
      while ($query->have_posts()) {
        $query->the_post();
        array_push($people, get_the_id());
      }
      wp_reset_query();
      break;
  }
  return $people;

}
