<?php
// Agregar la página de opciones a WordPress
// Función para crear la página de opciones del plugin
function chatgpt_options_page() {
    // Contenido de la página
    include( plugin_dir_path( __FILE__ ) . '../layouts/options-page.php' );

}

// Función para crear la primera pestaña del plugin
function chatgpt_general_settings_page() {
    // Contenido de la pestaña "General"
    pdcgpt_generar_descripciones();
}

// Función para crear la segunda pestaña del plugin
function chatgpt_configuration_settings_page() {
    // Contenido de la pestaña "Configuración"
    
    
    echo '<h1>Opciones Avanzadas</h1>';

    echo '<h4>Pronto implementaré funciones avanzadas para controlar las opciones que le enviarás a ChatGPT</h4>';

}

// Función para crear la tercera pestaña del plugin
function chatgpt_importer_settings_page() {
    // Contenido de la pestaña "Importador"
    pdcgpt_chatgpt_import_csv();
    pdcgpt_handle_csv();
}

// Función para crear la cuarta pestaña del plugin
function chatgpt_contact_settings_page() {
    // Contenido de la pestaña "Contacto"
    include( plugin_dir_path( __FILE__ ) . '../layouts/options-page-contacto.php' );

}

// Agregar las páginas del menú
add_action( 'admin_menu', 'chatgpt_add_menu_pages' );
function chatgpt_add_menu_pages() {
    // Crear la página principal del plugin
    add_menu_page(
        'ChatGPxT',
        'Descripciones AI',
        'manage_options',
        'chatgpt_options',
        'chatgpt_options_page',
        'dashicons-admin-generic',
        25
    );

    // Crear las pestañas del plugin
    add_submenu_page(
        'chatgpt_options',
        'Generar descripciones',
        'Generar descripciones',
        'manage_options',
        'chatgpt_general_settings',
        'chatgpt_general_settings_page'
    );

    add_submenu_page(
        'chatgpt_options',
        'Parámetros',
        'Parámetros',
        'manage_options',
        'chatgpt_configuration_settings',
        'chatgpt_configuration_settings_page'
    );

    add_submenu_page(
        'chatgpt_options',
        'Importador',
        'Importador',
        'manage_options',
        'chatgpt_importer_settings',
        'chatgpt_importer_settings_page'
    );

    add_submenu_page(
        'chatgpt_options',
        'Contacto',
        'Contacto',
        'manage_options',
        'chatgpt_contact_settings',
        'chatgpt_contact_settings_page'
    );
}