<?php

function wpdocs_custom_excerpt_length( $length ) { return 35; }
add_filter( 'excerpt_length', 'wpdocs_custom_excerpt_length', 999 );

function wpdocs_excerpt_more( $more ) { }
add_filter( 'excerpt_more', 'wpdocs_excerpt_more' );

function wordlimit($string, $length = 50, $ellipsis = "...")  {
   $words = explode(' ', $string);
   if (count($words) > $length)
       return implode(' ', array_slice($words, 0, $length)) . $ellipsis;
   else
       return $string;
}

function ds_excerpt() {
  $s = "";
  if (has_excerpt()) {
    $s = get_the_excerpt();
  }
  elseif( have_rows('layout') ) {
  //  $first = true;
  //  while ( have_rows('layout') && $first ) : the_row();
    while ( have_rows('layout') ) : the_row();
      switch (get_row_layout()) {
        case 'text' :
          $content = get_sub_field('content');
          $content = str_replace('</h4>', ' // ', $content);
          $content = str_replace('</h6>', ' // ', $content);
          $s .= strip_tags($content);
        //  $first = false;
        break;
      }
    endwhile;
    $s = wordlimit($s, 50, '...');
  }
  elseif(get_post_type() == 'people' ) {
    $s .= get_field('biography_excerpt');
  }
  elseif(get_post_type() == 'locations' ) {
    $s .= get_field('short_description');
  }
  elseif(get_post_type() == 'events' ) {
    $date = DateTime::createFromFormat('Ymd', get_field('date'));
    $s .= 'Event Date: '.$date->format('l F jS, Y').divider().get_field('short_description');
  }
  else {
    $s = get_the_excerpt();
  }
  return $s;
}
