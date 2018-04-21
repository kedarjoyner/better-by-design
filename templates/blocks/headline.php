<?php

function headline($layout, $i) {
  if($i === 0) {

  }
  else {
    if(  ($layout[($i)-1]['acf_fc_layout']) === 'headline' ) {
      $headline     = $layout[$i-1]['headline'];
      $subheadline  = $layout[$i-1]['subheadline'];
      $center       = $layout[$i-1]['center'];
      $class        = "";
      if($center) { $class = "center"; }
      echo '<article class="headline '.$class.'">';
        echo '<div class="full">';
          if($headline)    { echo '<h2>'.$headline.'</h2>'; }
          if($subheadline) { echo '<h4>'.$subheadline.'</h4>'; }
        echo '</div>';
      echo '</article>';
    }
  }

}

?>
