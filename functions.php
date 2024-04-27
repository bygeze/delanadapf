<?php
// En functions.php

// Enlazar el archivo CSS personalizado
function wpb_adding_styles() {
    wp_enqueue_style('custom-style', get_stylesheet_directory_uri() . '/css/styles.css');
}
add_action('wp_enqueue_scripts', 'wpb_adding_styles');