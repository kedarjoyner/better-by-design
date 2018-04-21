<?php

/* Add Typekit to Backend
**************************/
add_action( 'admin_head' , 'add_typekit' );
function add_typekit() {
  if(get_field('font_embed_code', 'option')) {
    echo get_field('font_embed_code', 'option'); }
}

/* Insert Editor Functions
**************************************/
function wpb_mce_buttons_2($buttons) {
	array_unshift($buttons, 'styleselect');
	return $buttons;
}
add_filter('mce_buttons_2', 'wpb_mce_buttons_2');
function my_mce_before_init_insert_formats( $init_array ) {
	$style_formats = array(
		array(
			'title' => 'Button',
			'selector' => 'a',
			'classes' => 'button',
			'wrapper' => false,
		),
    array(
			'title' => 'Solid Button',
			'selector' => 'a',
			'classes' => 'solid button',
			'wrapper' => false,
		),
    array(
			'title' => 'Secondary Button',
			'selector' => 'a',
			'classes' => 'secondary button',
			'wrapper' => false,
		),
    array(
			'title' => 'Solid Secondary Button',
			'selector' => 'a',
			'classes' => 'solid secondary button',
			'wrapper' => false,
		),
    array(
			'title' => 'Remove Paragraph Margin',
			'selector' => 'p',
			'classes' => 'remove_margin',
			'wrapper' => false,
		),
		array(
			'title' => 'Citation',
			'inline' => 'span',
			'classes' => 'cite',
			'wrapper' => false,
		),
	);
	$init_array['style_formats'] = json_encode( $style_formats );
	return $init_array;
}
add_filter( 'tiny_mce_before_init', 'my_mce_before_init_insert_formats' );

/* Add Editor Styles
**************************************/
function ds_add_editor_styles() {
  add_editor_style( 'css/editor.css' );
}
add_action( 'after_setup_theme', 'ds_add_editor_styles' );

function load_custom_wp_admin_style() {
    wp_register_style( 'ds_wp_admin_css', get_template_directory_uri() . '/css/admin.css', false, '1.0.0' );
    wp_enqueue_style( 'ds_wp_admin_css' );
}
add_action( 'admin_enqueue_scripts', 'load_custom_wp_admin_style' );

/* Remove Unused Buttons
**************************************/
add_filter( 'mce_buttons_2', 'acme_remove_firm_kitchen_sink');
function acme_remove_firm_kitchen_sink( $buttons ) {
 	$invalid_buttons = array(
			'underline',
			'alignjustify',
			'forecolor',
			'|',
      'strikethrough',
			'pastetext',
      'hr',  
			'pasteword',
			'outdent',
			'indent',
			'undo',
			'redo',
		);
	foreach ( $buttons as $button_key => $button_value ) {
		if ( in_array( $button_value, $invalid_buttons ) ) {
  		unset( $buttons[ $button_key ] );
		}
	}
	return $buttons;
}
add_filter( 'mce_buttons', 'acme_remove_firm_kitchen_sink_primary');
function acme_remove_firm_kitchen_sink_primary( $buttons ) {
 	$invalid_buttons = array(
    'strikethrough',
    //'alignleft',
    //'aligncenter',
    'alignright',
    'blockquote',

    //'link',
    //'unlink',
    'wp_more',
    'spellchecker',
    'fullscreen'
	);
	foreach ( $buttons as $button_key => $button_value ) {
		if ( in_array( $button_value, $invalid_buttons ) ) {
  	   unset( $buttons[ $button_key ] );
		}
	}
	return $buttons;
}

/* Remove Editor Formats
**************************************/
add_filter('tiny_mce_before_init', 'tiny_mce_remove_unused_formats' );
function tiny_mce_remove_unused_formats($init) {
	$init['block_formats'] = 'Headline=h2;Subheadline=h4;Paragraph=p;';
	return $init;
}
