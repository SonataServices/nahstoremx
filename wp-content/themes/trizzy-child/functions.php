<?php 
add_action( 'wp_enqueue_scripts', 'trizzy_enqueue_styles' );
function trizzy_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );

}


 
function remove_parent_theme_features() {
   	
}
add_action( 'after_setup_theme', 'remove_parent_theme_features', 10 );

?>