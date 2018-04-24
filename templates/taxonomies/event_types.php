<?php
date_default_timezone_set('America/Chicago');

$today = date('YmdHis');
$term = get_queried_object();

$args = array(
	'post_type' => 'events',
	'post_status' => 'publish',
	'posts_per_page' => -1,
	'order' => 'ASC',
	'orderby' => 'meta_value_num',
);
$args = array(
	'tax_query' => array(
		array(
			'taxonomy' => 'event_types',
			'field'    => 'term_id',
			'terms' => $term->term_id,
		)
	)
);

echo '<section class="event_block white">';
	echo '<article>';
		echo '<div class="full">';
			$query = new WP_Query($args);
			while ($query->have_posts()) {
				$query->the_post();
				if( get_field('date',get_the_id())>$today){
					event_preview();
				}
			}
			wp_reset_query();
		echo '</div>';
	echo '</article>';
echo '</section>';

?>