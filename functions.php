<?php

// ==========================================================================
// configuration du thème
// ==========================================================================

// affichage de la barre d'administration si les droits de l'utilisateur le permettent
if ( ! current_user_can( 'manage_options' ) ) {
    show_admin_bar( false );
} else {
    show_admin_bar( true );
}

// support de l'élément <title> par WordPress
// https://www.usablewp.com/learn-wordpress/home-page/how-to-add-theme-support-for-the-title-tag/
add_theme_support( 'title-tag' );


// support d'un logo personnalisé depuis le gestionnaire de thème
add_theme_support(
    'custom-logo',
    array(
        'height'      => 240,
        'width'       => 240,
        'flex-height' => true,
        'header-text' => array( 'site-title', 'site-description' )
    )
);


// support des images mises en avant
add_theme_support( 'post-thumbnails' );


// support du résumé dans les posts de type article
// https://www.wpbeginner.com/plugins/add-excerpts-to-your-pages-in-wordpress/
add_post_type_support( 'article', 'excerpt' );


// support des formats de posts (historiquement type de post de blog)
// https://www.wpbeginner.com/wp-themes/what-whys-and-how-tos-of-post-formats-in-wordpress-3-1/
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


// ==========================================================================
// fonctionnalités avancées du thème (hooks)
// ==========================================================================

// support du format SVG dans le centre de média
function custom_mime_types($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}

add_filter('upload_mimes', 'custom_mime_types');


// ajout d'une position de menu
// https://codepen.io/cyrilvernier/post/wordpress-4-creer-un-nouveau-menu
function startertheme_menu_setup() {    
    register_nav_menus(
        array( 'main-menu' => __( 'Main menu', 'startertheme' ) )
    );
}

add_action( 'after_setup_theme', 'startertheme_menu_setup' );


// chargement des feuilles de style personnalisées
// https://www.wpbeginner.com/wp-tutorials/how-to-properly-add-javascripts-and-styles-in-wordpress/
function startertheme_load_styles() {
    wp_register_style( 'startertheme-style', get_template_directory_uri() . '/css/main.css' );
    wp_enqueue_style( 'startertheme-style' );
}

add_action( 'wp_enqueue_scripts', 'startertheme_load_styles' );


// chargement des scripts JavaScript personnalisés
// https://www.wpbeginner.com/wp-tutorials/how-to-properly-add-javascripts-and-styles-in-wordpress/
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


// ajout de positions de widget
// https://codepen.io/cyrilvernier/post/wordpress-3-creer-une-nouvelle-zone-de-widgets
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


// déplacement des scripts JavaScript dans le footer du thème
// https://themesharbor.com/move-jquery-to-footer-in-wordpress/
function move_jquery_into_footer( $wp_scripts ) {

    if( is_admin() ) {
        return;
    }

    $wp_scripts->add_data( 'jquery', 'group', 1 );
    $wp_scripts->add_data( 'jquery-core', 'group', 1 );
    $wp_scripts->add_data( 'jquery-migrate', 'group', 1 );
}

add_action( 'wp_default_scripts', 'move_jquery_into_footer' );


// suppression des emojis (scripts parasites dans la page rendue)
// https://www.netmagik.com/how-to-disable-emojis-in-wordpress/
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