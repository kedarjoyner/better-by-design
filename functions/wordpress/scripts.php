<?php

// Jquery
// Just make sure to load from the CDN BEFORE you call wp_head
function my_scripts_method() { // Creates the my_scripts_method function
    wp_deregister_script('jquery'); // Deregisters the built-in version of jQuery
    wp_register_script( 'jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js');
    wp_enqueue_script( 'jquery' );
}
add_action('wp_enqueue_scripts', 'my_scripts_method'); // Tells WordPress to run the my_scripts_method function
