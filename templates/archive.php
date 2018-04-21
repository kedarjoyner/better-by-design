<?php

echo '<section class="archive">';
	echo '<article>';
		echo '<div class="full summaries">';
			echo '<div class="packery">';
			if ( have_posts() ) :
				$i = 0;
				while ( have_posts() ) : the_post();
					$class = "pack";
					if($i === 0 ) { $class .= ' banner'; }
					print_card($class);
					$i++;
				endwhile;
			else:
				echo '<h2>Whoops!</h2>';
				echo '<h4>We couldn\'t find anything.</h4>';
				echo '<p>It looks like there are no posts that match that description. Try searching for something else. We promise we will try hard to find something!</p>';
			endif;
			echo '</div>';
			echo '<aside class="sidebar">';
				echo '<div class="sticky">';
					dynamic_sidebar( 'main-sidebar' );
				echo '</div>';
			echo '</aside>';
		echo '</div>';
	echo '</article>';
echo '</section>';


$pagination = get_the_posts_pagination( array(
	'screen_reader_text' => 'Posts',
	'prev_text'          => '<i class="fa fa-caret-left"></i>Prev',
	'next_text'          => 'Next<i class="fa fa-caret-right"></i>',
	'before_page_number' => '',
) );
$pagination = str_replace('<h2 class="screen-reader-text">Posts</h2>', '', $pagination);
if($pagination) {
	echo '<section class="pagination gray">';
		echo '<article>';
			echo $pagination;
		echo '</article>';
	echo '</section>';
}

?>
