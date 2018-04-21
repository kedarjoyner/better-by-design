<?php

function theme() {
	echo get_template_directory_uri();
}

function divider() {
	return ' // ';
}

function echo_r($array) {
	echo '<pre>';
		print_r($array);
	echo '</pre>';
}

function get_post_date() {
	return get_the_time('M d Y');
}

function get_article_image($class = "") {
	$size = 'medium';
	$url  = "";
	$alt  = "";
	if ( has_post_thumbnail() ) {
		$temp = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_id()), $size);
		$thumbnail_id = get_post_thumbnail_id(get_the_id());
		$alt = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
		$url = $temp[0];
	}
	elseif (get_field('hero_photo')) {
		$hero = get_field('hero_photo');
		$url = $hero['sizes'][$size];
		$alt = $hero['alt'];
	}
	else {
		$default_hero = get_field('default_hero_image', 'options');
		$url = $default_hero['sizes'][$size];
		$alt = $default_hero['alt'];
	}
	echo '<figure>';
		echo '<img src="'.$url.'" alt="'.$alt.'" />';
		echo '<i class="fas fa-angle-right"></i>';
	echo '</figure>';
}

function get_page_headline($tag = "") {
	$headline = "";
	if     (is_home()) {                    $headline = get_field('blog_headline', 'options'); }
	elseif (is_archive()) {                 $headline = get_the_archive_title();    }
	elseif (is_search()) {                  $headline = 'Search';  }
	elseif (get_field('hero_headline')) {   $headline = get_field('hero_headline'); }
	else   {                                $headline = get_the_title();  }
	if($tag && $headline) { $headline = '<'.$tag.'>'.$headline.'</'.$tag.'>'; }
	return $headline;
}

function get_page_subheadline($tag = "") {
	$subheadline = "";
	if (is_home())          {  $subheadline = get_field('blog_subheadline', 'options'); }
	elseif (is_search())    {  $subheadline = '"'.get_search_query().'"'; }
	elseif (is_single())    {  $subheadline = get_post_date(); }
	elseif (get_field('hero_subheadline')) { $subheadline = get_field('hero_subheadline'); }
	if($tag && $subheadline) { $subheadline = '<'.$tag.'>'.$subheadline.'</'.$tag.'>'; }
	return $subheadline;
}

function get_hero_image_url() {
	$size         = 'large';
	$hero_url     = "";
	$hero_photo   = get_field('hero_photo');
	if (is_home() || is_archive() || is_search()) { // If Its the Blog Page
		$blog_hero = get_field('blog_hero', 'options');
		$hero_url  = $blog_hero['sizes'][$size];
	}
	elseif ( is_single() && has_post_thumbnail() ) {
		global $post;
		$temp = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), $size);
		$hero_url = $temp[0];
	}
	elseif ($hero_photo) {  // If a Hero Photo Exists
		$hero_url = $hero_photo['sizes'][$size];
	}
	else {
		$default_hero = get_field('default_hero_image', 'options');
		$hero_url     = $default_hero['sizes'][$size];
	}
	return $hero_url;
}


function get_summary_class() {
	if(has_post_thumbnail()) {
		return " has_thumbnail";
	}
}

function print_card($class = "") {
	echo '<div class="'.$class.'">';
		echo '<div class="card '.get_summary_class().'">';
			if(has_post_thumbnail() ) {
				get_article_image($class);
			}
			echo '<div class="preview">';
				echo '<div class="post_header">';
					echo '<h3>'.get_the_title().'</h3>';
					echo '<h5>'.get_post_date().'</h5>';
				echo '</div>';
				echo '<p>'.ds_excerpt().'</p>';
			echo '</div>';
			echo '<a class="article" href="'.get_the_permalink().'"><span class="sr">'.get_the_title().'<span></a>';
		echo '</div>';
	echo '</div>';
}

function is_card_page() {
	return (is_home() || is_archive() || is_search());
}

function is_no_hero_post() {
	$no_hero = array('people', 'events', 'post', 'locations');
	return is_singular($no_hero);
}

function get_hero_type() {
	$hero_type = 'hero_image';
	if( get_field('hero_type', get_the_id()) ) {
		$hero_type = get_field('hero_type', get_the_id());
	}

	if( is_no_hero_post() || is_404() || is_card_page() ) {
		$hero_type = 'no_hero';
	}

	// overrides
	if(is_singular('post') && get_field('use_featured_image_as_hero_photo')) {
		$hero_type = 'hero_image'; // override if blog post hero
	}
	if(is_card_page() && (get_field('archive_hero_style', 'options') == 'hero_image')) {
		$hero_type = 'hero_image'; // override if archive hero
	}
	return $hero_type;
}
