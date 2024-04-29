<?php
// En functions.php

// Enlazar el archivo CSS personalizado
function wpb_adding_styles() {
    wp_enqueue_style('custom-style', get_stylesheet_directory_uri() . '/css/styles.css');
}
add_action('wp_enqueue_scripts', 'wpb_adding_styles');

// Sets Handling
// Añadir un nuevo elemento al menú de administración de WordPress
add_action('admin_menu', 'add_sets_menu');

function add_sets_menu() {
    add_menu_page(
        'Sets', // Título de la página
        'Sets', // Título del menú
        'manage_options', // Capacidad requerida para acceder
        'sets', // Slug del menú
        'render_sets_page', // Función de renderizado del contenido
        'dashicons-admin-generic' // Icono del menú
    );
}

// Función de renderizado del contenido de la página "Sets"
function render_sets_page() {
    echo '<div class="wrap"><h1>Sets</h1><p>Hola Mundo!</p></div>';
}