<?php

add_theme_support( 'post-thumbnails' );
if ( function_exists( 'add_image_size' ) ) {
    add_image_size( 'large', 2240, 1400, true );
    add_image_size( 'medium', 810, 500, true );
    add_image_size( 'thumbnail', 350, 350, true );
    add_image_size( 'medium_large', 800, 800, false );
}

function cc_mime_types($mimes) {
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');


function add_classes_to_linked_images($html) {
    $classes = 'media_img'; // can do multiple classes, separate with space
    $patterns = array();
    $replacements = array();
    $patterns[0] = '/<a(?![^>]*class)([^>]*)>\s*<img([^>]*)>\s*<\/a>/'; // matches img tag wrapped in anchor tag where anchor tag where anchor has no existing classes
    $replacements[0] = '<a\1 class="' . $classes . '"><img\2></a>';
    $patterns[1] = '/<a([^>]*)class="([^"]*)"([^>]*)>\s*<img([^>]*)>\s*<\/a>/'; // matches img tag wrapped in anchor tag where anchor has existing classes contained in double quotes
    $replacements[1] = '<a\1class="' . $classes . ' \2"\3><img\4></a>';
    $patterns[2] = '/<a([^>]*)class=\'([^\']*)\'([^>]*)>\s*<img([^>]*)>\s*<\/a>/'; // matches img tag wrapped in anchor tag where anchor has existing classes contained in single quotes
    $replacements[2] = '<a\1class="' . $classes . ' \2"\3><img\4></a>';
    $html = preg_replace($patterns, $replacements, $html);
    return $html;
}
add_filter('the_content', 'add_classes_to_linked_images', 100, 1);
update_option('image_default_link_type','file');


add_filter('attachment_fields_to_edit', 'my_attachment_fields_edit', 10, 2);
function my_attachment_fields_edit($form_fields,$post){
    //Set attachment link to none and hide it.
    $html = "<input type='hidden' name='attachments[".$post->ID."][url]' value=''/>";

    $form_fields['url']['html'] = $html; //Replace html
    $form_fields['url']['label'] = ''; //Remove label
    $form_fields['url']['helps'] ='';//Remove help text

    return $form_fields;
}
