<?php

$name 		= get_the_title();
$link 		= get_the_permalink();
$job 			= get_field('job_title');
$bio 			= get_field('biography');
$headshot = get_field('headshot');
$site     = get_field('website');
$terms		= get_the_terms(get_the_id(), 'people_categories');



echo '<section class="single_person">';
	echo '<article>';
		echo '<div class="full">';
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
		echo '<div class="headline">';
			echo '<h1>'.$name.'</h1>';
			if($job) { echo '<h4>'.$job.'</h4>'; }
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
				if($bio) { echo $bio; }
				else { echo '<p>'.get_field('biography_excerpt').'</p>';}
			echo '</div>';
		echo '</div>';
		echo '</div>';
	echo '</article>';
echo '</section>';


$cats = get_the_terms(get_the_id(), 'people_categories');
if($cats) {
	echo '<section class="taxonomy_list">';
		echo '<ul class="location_types">';
			foreach ($cats as $term) { echo '<li><a href="'.get_term_link( $term ).'">'.$term->name."</a></li>"; }
		echo '</ul>';
	echo '</section>';
}


?>
