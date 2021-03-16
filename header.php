<!doctype html>
<html class="no-js" <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <title><?php wp_title( ' | ', true, 'right' ); ?> <?php bloginfo('name'); ?></title>
        
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <?php wp_head(); ?>
    </head>
    
    <body <?php body_class(); ?>>

<?php
// Détection du header à afficher selon la page chargée
if ( is_front_page() ) {
    get_template_part( 'template-parts/header', 'front' );
} else {
    get_template_part( 'template-parts/header', 'default' );
}
?>