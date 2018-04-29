<?php

function create_custom_posts() {
  register_post_type( 'people',
    array(
      'labels' => array(
        'name' => __( 'People' ),
        'singular_name' => __( 'Person' ),
        'add_new_item'        => __( 'Add New Person' ),
      ),
      'public' => true,
      'has_archive' => false,
      'menu_position' => 7,
      'menu_icon' => 'dashicons-admin-users',
    )
  );
  register_post_type( 'events',
    array(
      'labels' => array(
        'name' => __( 'Events' ),
        'singular_name' => __( 'Event' ),
        'add_new_item'        => __( 'Add New Event' ),
      ),
      'public' => true,
      'has_archive' => false,
      'menu_position' => 8,
      'menu_icon' => 'dashicons-calendar',
    )
  );
	flush_rewrite_rules(false);
}
add_action( 'init', 'create_custom_posts' );



function create_taxonomies() {
	register_taxonomy(
		'people_categories',
		'people',
		array(
			'label' => __( 'Categories' ),
      'hierarchical' => true,
      'show_admin_column' => true,
		)
	);
  register_taxonomy(
		'event_categories',
		'events',
		array(
			'label' => __( 'Categories' ),
      'hierarchical' => true,
      'show_admin_column' => true,
		)
  );
}
add_action( 'init', 'create_taxonomies' );

function change_title_text( $title ){
  $screen = get_current_screen();
  if  ( 'people' == $screen->post_type ) {
    $title = 'Enter Person\'s Name';
  }
  return $title;
}
add_filter( 'enter_title_here', 'change_title_text' );


add_filter( 'posts_orderby', function( $orderby, \WP_Query $q ) {
  if( 'wpse_last_word' === $q->get( 'orderby' ) && $get_order =  $q->get( 'order' ) ) {
    if( in_array( strtoupper( $get_order ), ['ASC', 'DESC'] ) ) {
      global $wpdb;
      $orderby = " SUBSTRING_INDEX( {$wpdb->posts}.post_title, ' ', -1 ) " . $get_order;
    }
  }
  return $orderby;
}, PHP_INT_MAX, 2 );
