<?php

function create_location_posts() {
	register_post_type( 'locations',
    array(
      'labels' => array(
        'name' => __( 'Locations' ),
        'singular_name' => __( 'Location' ),
        'add_new_item'        => __( 'Add New Location' ),
      ),
      'public' => true,
      'has_archive' => false,
      'menu_position' => 8,
      'menu_icon' => 'dashicons-location-alt',
    )
  );
	register_taxonomy(
		'regions',
		'locations',
		array(
			'label' => __( 'Regions' ),
			'hierarchical' => true,
			'labels' => array(
				'add_new_item' => 'Add New Region',
				'new_item_name' => 'New Region Name'
			)

		)
	);
	register_taxonomy(
		'location_type',
		'locations',
		array(
			'label' => __( 'Types' ),
			'hierarchical' => true,
			'labels' => array(
				'add_new_item' => 'Add New Type',
				'new_item_name' => 'New Region Type'
			)

		)
	);
	flush_rewrite_rules(false);
}
add_action( 'init', 'create_location_posts' );



function get_filters($filtering) {
  $filter_cats = array();
  switch ($filtering) {
    case 'by_region': /********************************************************/
      $filter_cats = get_sub_field('region_filters');
      if(!$filter_cats) {
        $filter_cats = get_terms( 'regions', array( 'hide_empty' => TRUE, ) );
      }
      break;
    case 'by_type':   /********************************************************/
      $filter_cats = get_sub_field('type_filters');
      if(!$filter_cats) {
        $filter_cats = get_terms( 'location_type', array( 'hide_empty' => TRUE, ) );
      }
      break;
    default: break;
  }
  if($filtering !== 'disable') {
    echo '<ul class="location_filter">';
      echo '<li data-filter=".show_all" class="active">Show All</li>';
      foreach ($filter_cats as $term) {
        echo '<li data-filter=".'.$term->slug.'">'.$term->name.'</li>';
      }
    echo '</ul>';
  }
}


function get_locations($populate_by, $tax = "") {
  $locations = array();
  $query_args = array(
    'post_type' => 'locations',
    'post_status' => 'publish',
    'posts_per_page' => -1
  );
  switch ($populate_by) {
    case 'by_region':
      $cats = get_sub_field('populate_region');
      if($cats) {
        $query_args['tax_query'] =
        array(
        'relation' => 'OR',
          array (
            'taxonomy' => 'regions',
            'field' => 'term_id',
            'terms' => $cats,
          )
        );
      }
      break;
    case 'by_type':
      $cats = get_sub_field('populate_type');
      if($cats) {
        $query_args['tax_query'] =
        array(
        'relation' => 'OR',
          array (
            'taxonomy' => 'location_type',
            'field' => 'term_id',
            'terms' => $cats,
          )
        );
      }
      break;
		case 'taxonomy':
			$term = get_queried_object();
			$query_args['tax_query'] =
				array(
				'relation' => 'OR',
					array (
						'taxonomy' => $tax,
						'field' => 'term_id',
						'terms' => $term->term_id,
					)
				);
			break;
    default: break;
  }


  $query = new WP_Query($query_args);
  while ($query->have_posts()) {
    $query->the_post();
    array_push($locations, get_the_id());
  }
  wp_reset_query();
  return $locations;
}


function display_locations($locations) {
  echo '<div class="location_container">';
  $index = 0;
  foreach ($locations as $location) {
    $id      = $location;
    $regions = get_the_terms($id, 'regions');
    $types   = get_the_terms($id, 'location_type');
    $class   = "show_all ";
    $loc     = get_field('location', $id);
    foreach ($regions as $term) { $class .= $term->slug." "; }
    foreach ($types as $term)   { $class .= $term->slug." "; }
    echo '<div class="location '.$class.'" data-index="'.$index.'" data-lat="'.$loc['lat'].'" data-lng="'.$loc['lng'].'">';
      $image = get_field('image', $id);
      $desc  = get_field('short_description', $id);
      if($image) {
        echo '<figure>';
          echo '<img src="'.$image['sizes']['thumbnail'].'" alt="Photo of '.get_the_title($id).'"/>';
        echo '</figure>';
      }
      echo '<h3>'.get_the_title($id).'</h3>';
      if($desc) { echo '<p class="description">'.$desc.'</p>'; }
      get_address('p', $id);
      echo '<p><a class="" href="'.get_the_permalink($id).'">Learn More</a><p>';
    echo '</div>';
    $index++;
  }
  echo '</div>';
}
