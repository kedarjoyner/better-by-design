<?php

/* Clean Up WP-Head
------------------------------*/
function bones_head_cleanup() {
  remove_action( 'wp_head', 'feed_links_extra', 3 ); // category feeds
  remove_action( 'wp_head', 'feed_links', 2 ); // post and comment feeds
  remove_action( 'wp_head', 'rsd_link' ); // EditURI link
  remove_action( 'wp_head', 'wlwmanifest_link' ); // windows live writer
  remove_action( 'wp_head', 'index_rel_link' ); // index link
  remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 ); // previous link
  remove_action( 'wp_head', 'start_post_rel_link', 10, 0 ); // start link
  remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 ); // links for adjacent posts
}
add_action('init', 'bones_head_cleanup');

//Remove Admin Bar Html

/* Disable Emojis
------------------------------*/
function disable_wp_emojicons() {
  remove_action( 'admin_print_styles', 'print_emoji_styles' );
  remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
  remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
  remove_action( 'wp_print_styles', 'print_emoji_styles' );
  remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
  remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
  remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
  add_filter( 'tiny_mce_plugins', 'disable_emojicons_tinymce' );
}
add_action( 'init', 'disable_wp_emojicons' );

function disable_emojicons_tinymce( $plugins ) {
  if ( is_array( $plugins ) ) { return array_diff( $plugins, array( 'wpemoji' ) ); }
  else { return array(); }
}

/* Remove Recent Comments Junk
------------------------------*/
add_action( 'widgets_init', 'my_remove_recent_comments_style' );
function my_remove_recent_comments_style() {
	global $wp_widget_factory;
	remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style'  ) );
}
