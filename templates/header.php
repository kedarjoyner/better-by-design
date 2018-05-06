<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <meta name="google-site-verification" content="" />
    <script src="<?php theme(); ?>/javascript/modernizr.js"></script>
    <?php
      if(get_field('font_embed_code', 'option')) {
        echo get_field('font_embed_code', 'option'); }
      if(get_field('google_analytics_embed_code', 'option')) {
        if ( !is_user_logged_in() ) {
            echo get_field('google_analytics_embed_code', 'option'); 
          }
        }
    ?>

    <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/style.css" />
    <?php
      $favicon = get_field('favicon', 'option');
      echo '<link rel="icon" type="image/png" href="'.$favicon['sizes']['thumbnail'].'" />';
    ?>

    <script src="<?php theme(); ?>/javascript/plugins/jquery.js"></script>

    <!-- Open Graph Data -->
    <meta property="og:title"     content="<?php echo get_page_headline(''); ?>" />
    <meta property="og:type"      content="website" />
    <meta property="og:url"       content="<?php echo get_the_permalink(); ?>" />
    <meta property="og:image"     content="<?php echo get_hero_image_url('hero'); ?>" />
    <meta property="og:site_name" content="<?php bloginfo('name'); ?>" />

    <?php wp_head();?>
  </head>
  <body <?php body_class(ds_body_class()); ?> >

<?php
$menu_search  = get_field('menu_search',  'options');
$hero_type    = get_hero_type();
echo '<nav class="main">';
  echo '<a class="logo" href="'.get_home_url().'">'.get_bloginfo( 'name' ).'</a>';
  echo '<ul class="top_level">';
  $main = array('theme_location' => 'main-menu', 'container' => ' ', 'items_wrap' => '%3$s' );
  wp_nav_menu($main);
  if($menu_search) { get_menu_search('li'); }
  echo '</ul>';
echo '</nav>';
echo '<nav class="mobile">';
  echo '<a class="mobile logo" href="'.get_home_url().'">'.get_bloginfo( 'name' ).'</a>';
  echo '<a class="toggle"><i class="fa fa-bars"></i></a>';
echo '</nav>';
echo '<main>';
  echo '<div class="close_menu"></div>'; // Darken Page
  require_once 'hero.php';
  hero($hero_type);
  echo '<span id="content"></span>';
?>
