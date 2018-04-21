<?php

function hero($hero_type) {
  $hero_class = "";
  switch ($hero_type) {

    /* No Hero
    ***********************************************************/
    case 'no_hero':
      if (!is_no_hero_post()) {
        echo '<header class="no_hero">';
          $headline    = get_page_headline('h1');
          $subheadline = get_page_subheadline('h2');
          if($headline) { echo $headline; }
          if($subheadline) { echo $subheadline; }
        echo '</header>';
      }
      break;

    /* Hero Image
    ***********************************************************/
    case 'hero_image':
      $size = get_field('hero_size');
      if(is_card_page()) { $size = 'small'; }
      echo '<header class="'.$size.'">';
        $hero_logo   = get_field('hero_logo');
        $headline    = get_page_headline('h1');
        $subheadline = get_page_subheadline('h2');
        if ($hero_logo) {	
            echo '<div class="hero-content">';
            echo '<div class="hero-logo">' . wp_get_attachment_image($hero_logo, array('245', '245')) . '</div>';
            echo '<div class="headline">';
              if($headline) { echo $headline; }
              if($subheadline) { echo $subheadline; }
            echo '</div></div>';
        } else {
            echo '<div class="headline">';
              if($headline) { echo $headline; }
              if($subheadline) { echo $subheadline; }
           echo '</div>';
        }
          if ($size == 'full') {
            echo '<a class="scroll" href="#content"><i class="fa fa-chevron-down"></i></a>';
          }
        get_hero();
      echo '</header>';
      break;

    /* Hero Video
    ***********************************************************/
    case 'hero_video':
      echo '<header class="video_hero">';
        $headline    = get_page_headline('h1');
        $subheadline = get_page_subheadline('h2');
        echo '<div class="headline">';
          if($headline) { echo $headline; }
          if($subheadline) { echo $subheadline; }
        echo '</div>';
        $video = get_field('video');
        if($video) {
          echo do_shortcode('[KGVID]'.$video["url"].'[/KGVID]');
        }
        $color       = get_field('overlay');
      	$opacity     = get_field('overlay_opacity');
      	$class       = 'video_overlay overlay '.$color.' opacity_'.$opacity;
        $mobile      = get_field('mobile_fallback');
        $photoclass  = 'hero_photo overlay '.$color.' opacity_'.$opacity;
        $style       = 'background-image: url('.$mobile['sizes']['large'].')';
        echo '<div class="'.$photoclass.'" style="'.$style.'"></div>';
      	echo '<div class="'.$class.'"></div>';
      echo '</header>';
      break;

    /* No Slider
    ***********************************************************/
    case 'hero_slider':
      $slides = get_field('hero_slides');
      echo '<header class="slider">';
      if($slides) {
        echo '<div class="owl-carousel">';
          foreach ($slides as $slide) {
            echo '<div class="item">';
              $color       = $slide['overlay'];
            	$opacity     = $slide['overlay_opacity'];
            	$class       = 'hero_photo overlay '.$color.' opacity_'.$opacity;
            	$style       = 'background-image: url('.$slide['hero_image']['sizes']['large'].')';
              $headline    = $slide['headline'];
              $subheadline = $slide['subheadline'];
              echo '<div class="headline">';
                if($headline) { echo '<h1>'.$headline.'</h1>'; }
                if($subheadline) { echo '<h2>'.$subheadline.'</h2>'; }
              echo '</div>';
            	echo '<div class="'.$class.'" style="'.$style.'"></div>';
            echo '</div>';
          }
        echo '</div>';
      }
      echo '</header>';
      break;
  }
}


function get_hero() {
	if ( is_card_page() ) {
		$color       = get_field('archive_overlay', 'options');
		$opacity     = get_field('archive_overlay_opacity', 'options');
	}
  else {
    $color       = get_field('overlay');
  	$opacity     = get_field('overlay_opacity');
  }
	$class       = 'hero_photo overlay '.$color.' opacity_'.$opacity;
	$style       = 'background-image: url('.get_hero_image_url('large').')';
	echo '<div class="'.$class.'" style="'.$style.'"></div>';
}




?>
