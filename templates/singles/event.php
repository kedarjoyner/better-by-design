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
$video_url   = get_field('video');
$slides		 = get_field('slides');
$gallery     = get_field('gallery');
$events_page = get_field('events_page', 'options');
$event_speakers = get_field('event_speakers');

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


			// Display categories
			$cats = get_the_terms(get_the_id(), 'event_categories');

			echo '<section class="taxonomy_list">';
			echo '<ul class="location_types">';
			if ($cats){
				foreach ($cats as $term) { 
					echo '<li><a href="'.get_term_link( $term ).'">'.$term->name."</a></li>";
				}
			}
			echo '</ul></section>';


		// Display return to events sidebar
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

			// Display event description
			echo '<div class="description">';
			if($description) {
				echo $description;
			} else {
				$short_description = get_field('short_description');
				echo '<p>'.$short_description.'</p>';
			}
			if($video_url) {
				echo '<a class="button secondary" href="'.$video_url.'" title="Watch video of event">Watch Video</a>';

			}
			if($slides) {
				echo '<a class="button secondary" href="'.$slides.'" title="Presentation slides from event">Download Presentation</a>';

			}
			echo '</div>';
		echo '</div>';
	echo '</article>';
echo '</section>';


/*
* Display speakers associated with event
*/

if ( $event_speakers ) {
	// Start of speaker section
	echo '<section class="people gray">';
		echo '<article>';
			echo '<div class="full">';
			echo '<div class="headline center"><h1>Speakers<h1></div>';

			// If more than two speakers don't center the speaker container
			if ( count($event_speakers) > 2 ) {
				echo '<div class="people_container">';
			} else {
				echo '<div class="people_container_center">';
			}
					// Loop through speakers
					foreach( $event_speakers as $post ) {

						// Makes global post equal to the speakers object
						setup_postdata( $post );

						$speaker_image = get_field('headshot');
						$name 		= get_the_title();
						$link 		= get_the_permalink();
						$job 		= get_field('job_title');
						$headshot = get_field('headshot');	
						
						// Start of speaker container 
						echo '<div class="person">';

						// Speaker image
						if($headshot) {
							echo '<div class="headshot">';
								echo '<img src="'.$headshot['sizes']['thumbnail'].'" alt="'.$headshot['alt'].'"/>';
							echo '</div>';
						}
						else {
							echo '<div class="headshot empty">';
								echo '<i class="fa fa-user"></i>';
							echo '</div>';
						}

						// Speaker name and job title
						echo '<div class="headline">';
							echo '<h3>'.$name.'</h3>';
							if($job) { 
								echo '<h4>'.$job.'</h4>'; 
							}
							echo '<a class="person_link" href="'.$link.'"><span class="sr">'.$name.'</span></a>';
						echo '</div>';
					
					// End of speaker container
					echo '</div>';
					
					}
			
			// End of speaker section	
				echo '</div>';
			echo '</div>';
		echo '</article>';		
	echo '</section>';
	
	wp_reset_postdata(); // reset post object to global post
}


// Show gallery of event images
if($gallery) {
	echo '<section class="gallery white">';
		dirigible_gallery($gallery);
  echo '</section>';
}

// Show event location map
if($location) {
	echo '<section class="map_block">';
    echo '<div class="map_location acf-map">';
      echo '<div class="marker" data-lat="'.$location['lat'].'" data-lng="'.$location['lng'].'"></div>';
    echo '</div>';
  echo '</section>';
}

?>
