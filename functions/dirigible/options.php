<?php
if( function_exists('acf_add_options_page') ) {
  acf_add_options_page();
  acf_add_options_sub_page('Theme Options');
  acf_add_options_sub_page('404 Page');
}


/*
* Below are the functions which retreive and show
* information from the options pages.
******************************************************/
function ds_body_class() {
	$class = "";
	if (get_field('enable_parallax', 'options')) { $class .= " parallax"; }
	$class .= " ".get_hero_type();
	return $class;
}


// site, link, title, icon
function display_social_icon($site, $link, $title, $icon) {
	if($link) {
		echo '<li>';
			echo '<a target="_blank" href="'.$site.$link.'">';
				echo '<i class="fab '.$icon.'"></i>';
				echo '<span class="sr">'.$title.'</span>';
			echo '</a>';
		echo '</li>';
	}
}

function social_media($tag = "", $id) {
	if($tag) { echo '<'.$tag.'>'; }
		echo '<ul class="media">';
			display_social_icon('http://facebook.com/', get_field('facebook', $id), 'Facebook', 'fa-facebook');
			display_social_icon('http://twitter.com/', get_field('twitter', $id), 'Twitter', 'fa-twitter');
			display_social_icon('http://instagram.com/', get_field('instagram', $id), 'Instagram', 'fa-instagram');
			display_social_icon('http://pinterest.com/', get_field('pinterest', $id), 'Pinterest', 'fa-pinterest');
			display_social_icon('http://linkedin.com/', get_field('linkedin', $id), 'LinkedIn', 'fa-linkedin');
			display_social_icon('http://youtube.com/', get_field('youtube', $id), 'Youtube Channel', 'fa-youtube');
		echo '</ul>';
	if($tag) { echo '</'.$tag.'>'; }
}

function get_address($tag, $id) {
  $street = get_field('street_address', $id );
  $city   = get_field('city', $id );
  $state  = get_field('state', $id );
  $zip    = get_field('zipcode', $id );
  if($street || $city || $state || $zip ){
    if($tag) { echo '<'.$tag.' class="address">'; }
  		echo '<span itemprop="address" itemscope itemtype="http://schema.org/PostalAddress"> ';
  			if ($street) echo '<span itemprop="streetAddress">'.$street.'</span><br/>';
  			if ($city) echo '<span itemprop="addressLocality">'.$city.'</span>, ';
  			if ($state) echo '<span itemprop="addressRegion">'.$state.'</span>, ';
  			if ($zip) echo '<span itemprop="postalCode">'.$zip.'</span>';
  		echo '</span>';
  	if($tag) { echo '</'.$tag.'>'; }
  }
}

function get_email($tag = "", $id, $display = TRUE) {
  $email = get_field('email_address', $id);
	if ($email)  {
		if($tag) { echo '<'.$tag.'>'; }
			echo '<a itemprop="email" href="mailto:'.$email.'">';
        if($display) {
          echo $email;
        }
        else { echo 'Email'; }
      echo '</a>';
		if($tag) { echo '</'.$tag.'>'; }
	}
}

function get_phone($tag = "", $id) {
  $phone = get_field('phone', $id);
	if ($phone)  {
		if($tag) { echo '<'.$tag.'>'; }
			echo '<span itemprop="phone"><a href="tel:'.$phone.'">'.$phone.'</a></span>';
		if($tag) { echo '</'.$tag.'>'; }
	}
}

function get_copyright($tag = "", $id) {
	if($tag) { echo '<'.$tag.'>'; }
		echo '&copy <span itemprop="name">'.get_field('copyright_holder', 'options').'</span>';
	if($tag) { echo '</'.$tag.'>'; }
}

function get_menu_search($tag = "") {
	if($tag) { echo '<'.$tag.'>'; }
    echo '<form role="search" method="get" id="searchform" class="searchform" action="'.esc_url( home_url( '/' ) ).'">';
      echo '<div>';
				echo '<label for="menu_search" class="sr">Search This Site</label>';
        echo '<input id="menu_search" type="text"  placeholder="Search" value="'.get_search_query().'" name="s" id="s" />';
        echo '<button class="search-submit" id="searchsubmit">';
					echo '<i class="fas fa-search"></i>';
					echo '<span class="sr">Submit Search</span>';
				echo '</button> ';
      echo '</div>';
    echo '</form>';
	if($tag) { echo '</'.$tag.'>'; }
}
