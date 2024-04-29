<?php
// En functions.php

// Enlazar el archivo CSS personalizado
function wpb_adding_styles() {
    wp_enqueue_style('custom-style', get_stylesheet_directory_uri() . '/css/styles.css');
}
add_action('wp_enqueue_scripts', 'wpb_adding_styles');

// Sets Handling

// Función para crear la tabla de sets al activar el tema
register_activation_hook( __FILE__, 'crear_tabla_sets' );

function crear_tabla_sets() {
    global $wpdb;
    $tabla_sets = $wpdb->prefix . 'sets';

    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $tabla_sets (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        titulo varchar(100) NOT NULL,
        soundcloud_link varchar(255) NOT NULL,
        youtube_link varchar(255) NOT NULL,
        thumbnail varchar(255) NOT NULL,
        PRIMARY KEY  (id)
    ) $charset_collate;";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );
}

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
    global $wpdb;
    $tabla_sets = $wpdb->prefix . 'sets';
    ?>
    <div class="wrap">
        <h1>Sets</h1>

        <!-- Formulario para añadir sets -->
        <h2>Añadir Nuevo Set</h2>
        <form method="post" enctype="multipart/form-data" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
            <!-- Campo de nonce de seguridad -->
            <?php wp_nonce_field('add_set_nonce', 'add_set_nonce'); ?>

            <label for="titulo">Título:</label><br>
            <input type="text" name="titulo" id="titulo" required><br>

            <label for="soundcloud_link">Enlace de SoundCloud:</label><br>
            <input type="text" name="soundcloud_link" id="soundcloud_link" required><br>

            <label for="youtube_link">Enlace de YouTube:</label><br>
            <input type="text" name="youtube_link" id="youtube_link" required><br>

            <label for="thumbnail">Thumbnail:</label><br>
            <input type="file" name="thumbnail" id="thumbnail" accept="image/*" required><br>

            <!-- Campo de acción para manejar la subida de sets -->
            <input type="hidden" name="action" value="add_set">

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
                <?php
                // Obtener y mostrar los sets de la base de datos
                $sets = $wpdb->get_results("SELECT * FROM $tabla_sets");
                foreach ($sets as $set) {
                    echo '<tr>';
                    echo '<td>' . esc_html($set->titulo) . '</td>';
                    echo '<td><a href="' . esc_url($set->soundcloud_link) . '" target="_blank">' . esc_html($set->soundcloud_link) . '</a></td>';
                    echo '<td><a href="' . esc_url($set->youtube_link) . '" target="_blank">' . esc_html($set->youtube_link) . '</a></td>';
                    echo '<td><img src="' . esc_url($set->thumbnail) . '" width="100"></td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
    <?php
}



// Función para manejar la subida de sets
add_action('admin_post_add_set', 'add_set_to_database');

function add_set_to_database() {
    // Verificar el nonce de seguridad
    if ( !isset($_POST['add_set_nonce']) || !wp_verify_nonce($_POST['add_set_nonce'], 'add_set_nonce') ) {
        wp_die('Error de seguridad. Por favor, inténtalo de nuevo.');
    }

    // Obtener los datos del formulario
    $titulo = sanitize_text_field($_POST['titulo']);
    $soundcloud_link = esc_url_raw($_POST['soundcloud_link']);
    $youtube_link = esc_url_raw($_POST['youtube_link']);

    // Manejar la subida del thumbnail
    $thumbnail = ''; // Inicializamos la variable
    if (isset($_FILES['thumbnail']) && $_FILES['thumbnail']['error'] === UPLOAD_ERR_OK) {
        $thumbnail_file = $_FILES['thumbnail'];
        $upload_overrides = array('test_form' => false);
        $uploaded_file = wp_handle_upload($thumbnail_file, $upload_overrides);

        if (!empty($uploaded_file['url'])) {
            $thumbnail = $uploaded_file['url'];
        }
    }

    // Insertar los datos en la base de datos
    global $wpdb;
    $wpdb->insert(
        $wpdb->prefix . 'sets', // Tabla personalizada para los sets
        array(
            'titulo' => $titulo,
            'soundcloud_link' => $soundcloud_link,
            'youtube_link' => $youtube_link,
            'thumbnail' => $thumbnail
        )
    );

    // Redireccionar de vuelta a la página de sets
    wp_redirect(admin_url('admin.php?page=sets'));
    exit;
}