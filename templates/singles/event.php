<?php

$title       = get_the_title();
$date        = DateTime::createFromFormat('YmdHis', get_field('date'));
$end_date    = DateTime::createFromFormat('YmdHis', get_field('end_date'));
$description = get_field('full_description');
$venue       = get_field('venue');
$multi_day   = get_field('multi-day');
$image       = get_field('image');
$image       = get_field('featured_image');
$location    = get_field('location');
$site        = get_field('website');
$gallery     = get_field('gallery');
$events_page = get_field('events_page', 'options');

echo '<section class="single_event white">';
	echo '<article>';
		echo '<div class="full">';
		if($image) {
			echo '<figure>';
				echo '<img src="'.$image['sizes']['medium'].'" alt="'.$image['alt'].'"/>';
			echo '</figure>';
		}
		echo '<div class="headline">';
			echo '<h1>'.$title.'</h1>';
			echo '<h4>';
				echo $date->format('l, F jS, Y');
				if($multi_day && $end_date) { echo ' — '.$end_date->format('l, F jS, Y'); }
			echo '</h4>';
		echo '</div>';
		echo '<div class="information">';
			echo '<div class="contact">';
				echo '<div class="event_details">';
					echo '<p class="date">';
						echo $date->format('F jS');
						if($multi_day && $end_date) {
							echo ' — '.$end_date->format(' F jS');
						}
					echo '</p>';
					echo '<p>';
						echo $date->format('g:i a');
						if($venue) { echo ' @ '.$venue; }
					echo '</p>';
				echo '</div>';
				get_address('p', get_the_id());
				echo '<ul class="tags">';
					get_phone('li', get_the_id());
					get_email('li', get_the_id(), FALSE);
					if($site) echo '<li><a href="'.$site['url'].'">Site</a></li>';
				echo '</ul>';
				if($events_page) {
					echo '<a class="button solid return" href="'.$events_page.'">Return to Events</a>';
				}
			echo '</div>';



			echo '<div class="description">';
			if($description) {
				echo $description;
			}
			else {
				$short_description = get_field('short_description');
				echo '<p>'.$short_description.'</p>';
			}
			echo '</div>';
		echo '</div>';
	echo '</article>';
echo '</section>';


$cats = get_the_terms(get_the_id(), 'event_categories');
if($cats) {
	echo '<section class="taxonomy_list">';
		echo '<ul class="location_types">';
			foreach ($cats as $term) { echo '<li><a href="'.get_term_link( $term ).'">'.$term->name."</a></li>"; }
		echo '</ul>';
	echo '</section>';
}


if($gallery) {
	echo '<section class="gallery white">';
		dirigible_gallery($gallery);
  echo '</section>';
}

if($location) {
	echo '<section class="map_block">';
    echo '<div class="map_location acf-map">';
      echo '<div class="marker" data-lat="'.$location['lat'].'" data-lng="'.$location['lng'].'"></div>';
    echo '</div>';
  echo '</section>';
}

?>
