<?php

if ( have_posts() ) : while ( have_posts() ) : the_post();
echo '<div class="post">';
	echo '<section class="text white">';
		echo '<article>';
			echo '<div class="full">';
				if(!get_field('use_featured_image_as_hero_photo')) {
					if ( has_post_thumbnail() ) {
						$size = 'full';
						$temp = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_id()), $size);
						$thumbnail_id = get_post_thumbnail_id(get_the_id());
						$alt = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
						$url = $temp[0];
						echo '<img class="featured_image" src="'.$url.'" alt="'.$alt.'" />';
					}
					echo '<h1 class="post_title">'.get_the_title().'</h1>';
					echo '<h4>'.get_post_date().'</h4>';

				}
				the_content();
			echo '</div>';
		echo '</article>';
	echo '</section>';
	get_template_part( 'templates/layouts' );
echo '</div>';
endwhile; endif;


$cats = wp_get_post_categories(get_the_id());
if($cats) {
	echo '<section class="post_categories">';
		echo '<ul class="categories">';
		foreach($cats as $c){
				$cat = get_category( $c );
				echo '<li><a href="'.get_category_link( $cat->term_id ).'">'.$cat->name.'</a></li>';
		}
		echo '</ul>';
	echo '</section>';
}


echo '<section class="post nav">';
	echo '<article>';
		echo '<div class="half">';
			echo next_post_link('%link', '<h4>Previous Post</h4><p>%title</p>', false);
		echo '</div>';
		echo '<div class="half right">';
			echo previous_post_link('%link', '<h4>Next Post</h4><p>%title</p>', false);
		echo '</div>';
	echo '</article>';
echo '</section>';

?>
