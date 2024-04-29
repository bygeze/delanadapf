<?php
// En functions.php

// Enlazar el archivo CSS personalizado
function wpb_adding_styles() {
    wp_enqueue_style('custom-style', get_stylesheet_directory_uri() . '/css/styles.css');
}
add_action('wp_enqueue_scripts', 'wpb_adding_styles');

// Sets Handling
add_action('admin_menu', 'register_sets_page');
function register_sets_page() {
    add_menu_page('Sets', 'Sets', 'manage_options', 'sets', 'sets_page_callback');
}

function sets_page_callback() {
    ?>
    <div class="wrap">
        <h2>Agregar Nuevo Set</h2>
        <form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
            <?php wp_nonce_field('add_set', 'add_set_nonce'); ?>
            <label for="set_image">Imagen:</label>
            <input type="text" name="set_image" id="set_image" required><br>
            <label for="set_title">Título:</label>
            <input type="text" name="set_title" id="set_title" required><br>
            <label for="set_link">Enlace:</label>
            <input type="text" name="set_link" id="set_link" required><br>
            <input type="hidden" name="action" value="add_set">
            <input type="submit" value="Agregar Set" class="button-primary">
        </form>
    </div>
    <?php
}

add_action('admin_post_add_set', 'add_set_to_database');
function add_set_to_database() {
    // Verificar el nonce
    if (!isset($_POST['add_set_nonce']) || !wp_verify_nonce($_POST['add_set_nonce'], 'add_set')) {
        wp_die('Error de seguridad');
    }

    // Obtener los datos del formulario
    $set_image = sanitize_text_field($_POST['set_image']);
    $set_title = sanitize_text_field($_POST['set_title']);
    $set_link = sanitize_text_field($_POST['set_link']);

    // Insertar los datos en la base de datos
    global $wpdb;
    $wpdb->insert(
        $wpdb->prefix . 'sets', // Tabla personalizada para los sets
        array(
            'image' => $set_image,
            'title' => $set_title,
            'link' => $set_link
        )
    );

    // Redireccionar de vuelta a la página de sets
    wp_redirect(admin_url('admin.php?page=sets'));
    exit;
}

function sets_page_callback() {
    // Código para mostrar el formulario de agregar sets

    // Mostrar la lista de sets
    global $wpdb;
    $sets = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}sets");

    echo '<h2>Sets Existente</h2>';
    echo '<table class="wp-list-table widefat fixed striped">';
    echo '<thead><tr><th>Imagen</th><th>Título</th><th>Enlace</th></tr></thead>';
    echo '<tbody>';
    foreach ($sets as $set) {
        echo '<tr>';
        echo '<td><img src="' . esc_url($set->image) . '" width="100"></td>';
        echo '<td>' . esc_html($set->title) . '</td>';
        echo '<td><a href="' . esc_url($set->link) . '" target="_blank">' . esc_html($set->link) . '</a></td>';
        echo '</tr>';
    }
    echo '</tbody></table>';
}