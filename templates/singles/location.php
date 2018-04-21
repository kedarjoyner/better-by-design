<?php

$name 		= get_the_title();
$link 		= get_the_permalink();
$job 			= get_field('job_title');
$desc 		= get_field('full_description');
$excerpt 	= get_field('short_description');
$image 		= get_field('image');
$site 		= get_field('website');


echo '<section class="single_location white">';
	echo '<article>';
		echo '<div class="full">';
			echo '<figure>';
				echo '<img src="'.$image['sizes']['medium'].'" alt="Photo of '.$name.'"/>';
			echo '</figure>';
			echo '<div class="headline">';
				echo '<h1>'.$name.'</h1>';
				$regions = "";
				$cats = get_the_terms(get_the_id(), 'regions');
				if($cats) {
					foreach ($cats as $term) {
						$regions .= '<a href="'.get_term_link( $term ).'">'.$term->name."</a>, ";
					}
				}
				if($regions) echo '<h4>'.substr($regions, 0, -2).'</h4>';
			echo '</div>';
			echo '<div class="information">';
				echo '<div class="contact">';
					get_address('p', get_the_id());
					social_media('', get_the_id());
					echo '<ul class="tags">';
						get_phone('li', get_the_id());
						get_email('li', get_the_id(), FALSE);
						if($site) echo '<li><a href="'.$site['url'].'">Site</a></li>';
					echo '</ul>';
				echo '</div>';
				echo '<div class="description">';
					if($desc) { echo $desc; }
					else { echo '<p>'.$excerpt.'</p>';}
				echo '</div>';
			echo '</div>';
		echo '</div>';
	echo '</article>';

echo '</section>';

$cats = get_the_terms(get_the_id(), 'location_type');
if($cats) {
	echo '<section class="taxonomy_list">';
		echo '<ul class="location_types">';
			foreach ($cats as $term) { echo '<li><a href="'.get_term_link( $term ).'">'.$term->name."</a></li>"; }
		echo '</ul>';
	echo '</section>';
}


?>
