<?php

if ( ! current_user_can( 'manage_options' ) ) {
    show_admin_bar( false );
} else {
    show_admin_bar( true );
}

add_theme_support( 'title-tag' );

add_theme_support(
			'custom-logo',
			array(
				'height'      => 240,
				'width'       => 240,
				'flex-height' => true,
                'header-text' => array( 'site-title', 'site-description' )
			)
		);

add_theme_support( 'post-thumbnails' );

add_post_type_support( 'article', 'excerpt' );

add_theme_support(
			'post-formats',
			array(
				'aside',
				'image',
				'video',
				'quote',
				'link',
				'gallery',
				'audio',
			)
		);

function custom_mime_types($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}

add_filter('upload_mimes', 'custom_mime_types');


function startertheme_setup() {    
    register_nav_menus(
        array( 'main-menu' => __( 'Main menu', 'startertheme' ) )
    );
}

add_action( 'after_setup_theme', 'startertheme_setup' );


function startertheme_load_styles() {
    wp_register_style( 'startertheme-style', get_template_directory_uri() . '/css/main.css' );
    wp_enqueue_style( 'startertheme-style' );
}

add_action( 'wp_enqueue_scripts', 'startertheme_load_styles' );


function startertheme_load_scripts() {
    wp_register_script( 'startertheme-jquery', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js' );
    wp_register_script( 'startertheme-plugins', get_template_directory_uri() . '/js/plugins.js' );
    wp_register_script( 'startertheme-scripts', get_template_directory_uri() . '/js/main.js' );
//    wp_enqueue_script( 'jquery' );
    wp_enqueue_script( 'startertheme-jquery', array(), '3.4.1', true );
    wp_enqueue_script( 'startertheme-plugins', array(), '1.0.0', true );
    wp_enqueue_script( 'startertheme-scripts', array(), '1.0.0', true );
}

add_action( 'wp_enqueue_scripts', 'startertheme_load_scripts' );


function startertheme_widgets_init() {
    register_sidebar( array (
        'name' => __( 'Aside Widget Area', 'startertheme' ),
        'id' => 'aside',
        'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
        'after_widget' => "</div>",
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>'
    ) );
    
    register_sidebar( array (
        'name' => __( 'Footer Widget Area', 'startertheme' ),
        'id' => 'footer',
        'class' => 'row',
        'before_widget' => '<section id="%1$s" class="widget-container %2$s col-12 col-sm-6 col-md-4">',
        'after_widget' => "</section>",
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );
}

add_action( 'widgets_init', 'startertheme_widgets_init' );


function move_jquery_into_footer( $wp_scripts ) {

    if( is_admin() ) {
        return;
    }

    $wp_scripts->add_data( 'jquery', 'group', 1 );
    $wp_scripts->add_data( 'jquery-core', 'group', 1 );
    $wp_scripts->add_data( 'jquery-migrate', 'group', 1 );
}

add_action( 'wp_default_scripts', 'move_jquery_into_footer' );


function disable_wp_emojicons() {

  // all actions related to emojis
  remove_action( 'admin_print_styles', 'print_emoji_styles' );
  remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
  remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
  remove_action( 'wp_print_styles', 'print_emoji_styles' );
  remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
  remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
  remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );

  // filter to remove TinyMCE emojis
  add_filter( 'tiny_mce_plugins', 'disable_emojicons_tinymce' );
}

add_action( 'init', 'disable_wp_emojicons' );

?>