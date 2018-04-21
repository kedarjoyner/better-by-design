<?php

require_once 'blocks/text.php';
require_once 'blocks/gallery.php';
require_once 'blocks/image_pull.php';
require_once 'blocks/image_grid.php';
require_once 'blocks/half_page.php';
require_once 'blocks/recent_posts.php';
require_once 'blocks/headline.php';
require_once 'blocks/people.php';
require_once 'blocks/map.php';
require_once 'blocks/events.php';
require_once 'blocks/quote.php';
require_once 'blocks/page_scroller.php';
require_once 'blocks/locations.php';

$id = get_the_id();
if(is_404()) { $id = 'options'; }
$layout = get_field('layout', $id);
$i = 0;

if( have_rows('layout', $id) ) {
  while ( have_rows('layout', $id) ) : the_row();
    scroller($i);
    switch (get_row_layout()) {
      case 'text'          : text($layout, $i);            break;
      case 'gallery'       : gallery($layout, $i);         break;
      case 'image_pull'    : image_pull($layout, $i);      break;
      case 'image_grid'    : image_grid($layout, $i);      break;
      case 'half_page'     : half_page($layout, $i);       break;
      case 'recent_posts'  : recent_posts($layout, $i);    break;
      case 'people'        : people($layout, $i);          break;
      case 'map'           : map($layout, $i);             break;
      case 'events'        : events($layout, $i);          break;
      case 'quote'         : quote($layout, $i);           break;
      case 'page_scroller' : page_scroller($layout, $i);   break;
      case 'locations'     : locations($layout, $i);       break;
    }
    $i++;
  endwhile;
}

function scroller($i) {
  $title      = get_sub_field('scroller_title');
  $section_id = get_sub_field('section_id');
  if($section_id) {
    echo '<div id="'.$section_id.'"></div>';
  }
  elseif($title) {
    echo '<div id="section_'.$i.'"></div>';
  }
}


?>
