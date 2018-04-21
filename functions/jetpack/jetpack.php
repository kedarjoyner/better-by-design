<?php

function jptweak_remove_share() {
    remove_filter( 'the_content', 'sharing_display',19 );
    remove_filter( 'the_excerpt', 'sharing_display',19 );
    remove_filter( 'dirigible_events_the_content', 'sharing_display',20 );
		if ( class_exists( 'Jetpack_Likes' ) ) {
        remove_filter( 'the_content', array( Jetpack_Likes::init(), 'post_likes' ), 30, 1 );
    }
}
add_action( 'loop_start', 'jptweak_remove_share' );


function jetpack_remove_related_posts() {
	$jprp = Jetpack_RelatedPosts::init();
	$callback = array($jprp, 'filter_add_target_to_dom');
	remove_filter('the_content', $callback, 40);
}

add_filter('wp', 'jetpack_remove_related_posts', 20);
//This keeps the built in jetpack gallery from being too small
if ( !isset($content_width) ) {  $content_width = 980; }
