<?php

//Sidebar
//We will need to register more or make a flexible sidebar
if (function_exists("register_sidebar")) {
  	register_sidebar(array(
	    'name' => 'Main Sidebar',
	    'id' => 'main-sidebar',
	    'before_widget' => '<div class="widget">',
	    'after_widget' => '</div>',
	    'before_title' => '<h5>',
	    'after_title' => '</h5>',
	));
}

// Menus
function register_menus() {
  register_nav_menu('main-menu',__( 'Main Menu' ));
  register_nav_menu('footer-menu',__( 'Footer Menu' ));
}
add_action( 'init', 'register_menus' );



// Remove the href from empty links `<a href="#">` in the nav menus
function wpse_remove_empty_links( $menu ) {
    return str_replace( '<a href="#">', '<a class="empty_link">', $menu );
}
add_filter( 'wp_nav_menu_items', 'wpse_remove_empty_links' );
