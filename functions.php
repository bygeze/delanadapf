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
    ?>
    <div class="wrap">
        <h1>Sets</h1>

        <!-- Formulario para añadir sets -->
        <h2>Añadir Nuevo Set</h2>
        <form method="post" enctype="multipart/form-data">
            <label for="titulo">Título:</label><br>
            <input type="text" name="titulo" id="titulo" required><br>

            <label for="soundcloud_link">Enlace de SoundCloud:</label><br>
            <input type="text" name="soundcloud_link" id="soundcloud_link" required><br>

            <label for="youtube_link">Enlace de YouTube:</label><br>
            <input type="text" name="youtube_link" id="youtube_link" required><br>

            <label for="thumbnail">Thumbnail:</label><br>
            <input type="file" name="thumbnail" id="thumbnail" accept="image/*" required><br>

            <input type="submit" name="submit" value="Subir" class="button-primary">
        </form>

        <!-- Tabla para mostrar los sets -->
        <h2>Sets Agregados</h2>
        <table class="wp-list-table widefat fixed striped">
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Enlace de SoundCloud</th>
                    <th>Enlace de YouTube</th>
                    <th>Thumbnail</th>
                </tr>
            </thead>
            <tbody>
                <!-- Aquí se mostrarán los sets agregados -->
            </tbody>
        </table>
    </div>
    <?php
}