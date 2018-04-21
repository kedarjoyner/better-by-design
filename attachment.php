<?php
if ( have_posts() ) : while ( have_posts() ) : the_post();

echo '<img src="'.wp_get_attachment_url($post->id).'" />';
// wp_redirect(wp_get_attachment_url($post->id));
// wp_redirect(wp_get_attachment_url($post->id));
endwhile; endif;
?>
