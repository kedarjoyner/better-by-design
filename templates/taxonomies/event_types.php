<?php
date_default_timezone_set('America/Chicago');
$today      = date('Ymd');

$args = array(
	'post_type' => 'events',
	'post_status' => 'publish',
	'posts_per_page' => -1,
	'order' => 'ASC',
	'orderby' => 'meta_value_num',
	'meta_key' => 'date',
	'meta_value' => $today,
	'meta_compare' => '>='
);
$args = array(
	'tax_query' => array(
		array(
			'taxonomy' => 'event_types',
			'terms' => '24'
		)
	)
);

echo '<section class="event_block white">';
	echo '<article>';
		echo '<div class="full">';
			$query = new WP_Query($args);
			while ($query->have_posts()) {
				$query->the_post();
				event_preview();
			}
			wp_reset_query();
		echo '</div>';
	echo '</article>';
echo '</section>';

?>