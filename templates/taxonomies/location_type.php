<?php

$i = 0;
echo '<section class="locations white" data-map="map-'.$i.'" >';
	echo '<div class="dynamic-map map-'.$i.'" data-map="map-'.$i.'" ></div>';
	echo '<article>';
		echo '<div class="full">';
			$locations = get_locations('taxonomy', 'location_type');
			display_locations($locations);
		echo '</div>';
	echo '</article>';
echo '</section>';

?>
