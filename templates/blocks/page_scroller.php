<?php

function page_scroller($layout, $i) {
  $sections = array();
  $id = get_the_id();
  $layout = get_field('layout', $id);
  $iter = 0;
  if($layout) {
    foreach ($layout as $block) {
      if(isset($block['scroller_title'])) {
        $title = $block['scroller_title'];
        $section_id = $block['section_id'];
        if($title) {
          $str = 'section_'.$iter;
          if($section_id) { $str = $section_id; }
          $push = array($title, $str);
          array_push($sections, $push);
        }
      }
      $iter++;
    }
  }
  echo '<section class="page_scroller gray sticky">';
    echo '<ul>';
    foreach ($sections as $section) {
      echo '<li><a href="#'.$section[1].'">'.$section[0].'</a></li>';
    }
    echo '</ul>';
  echo '</section>';
}
