<?php
if ( ! function_exists( 'twentyfifteen_comment_nav' ) ) :
function twentyfifteen_comment_nav() {
	if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
	?>
	<nav class="navigation comment-navigation" role="navigation">
		<h2 class="screen-reader-text"><?php _e( 'Comment navigation', 'twentyfifteen' ); ?></h2>
		<div class="nav-links">
			<?php
				if ( $prev_link = get_previous_comments_link( __( 'Older Comments', 'twentyfifteen' ) ) ) :
					printf( '<div class="nav-previous">%s</div>', $prev_link );
				endif;
				if ( $next_link = get_next_comments_link( __( 'Newer Comments', 'twentyfifteen' ) ) ) :
					printf( '<div class="nav-next">%s</div>', $next_link );
				endif;
			?> 
		</div><!-- .nav-links -->
	</nav><!-- .comment-navigation -->
	<?php
	endif;
}
endif;
