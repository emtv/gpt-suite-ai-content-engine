<?php 

// Registra la acción de guardar la API Key
add_action( 'admin_post_save_api_key', 'chatgpt_save_api_key' );

if (!function_exists('chatgpt_save_api_key')) {
    function chatgpt_save_api_key() {
    // Verifica el nonce
    if ( ! isset( $_POST['chatgpt_api_key_nonce'] ) || ! wp_verify_nonce( $_POST['chatgpt_api_key_nonce'], 'save_api_key' ) ) {
        wp_die( 'Error de seguridad. Por favor, intenta de nuevo.' );
    }

    // Verifica si se envió la API Key
    if ( ! isset( $_POST['api_key'] ) ) {
        wp_die( 'No se recibió una API Key. Por favor, intenta de nuevo.' );
    }

    // Actualiza la opción de la API Key
    update_option( 'chatgpt_api_key', sanitize_text_field( $_POST['api_key'] ) );

    // Redirige a la página de configuración con un mensaje de éxito
    wp_redirect( admin_url( 'admin.php?page=chatgpt_general_settings&updated=true' ) );
    exit;
    }
}

// Función que se ejecuta al presionar el botón en la página de opciones
if (!function_exists('gsce_api_connection_and_products')) {
    function gsce_api_connection_and_products() {
        // Conectarse al API de ChatGPT
        $api_url = 'https://api.openai.com/v1/engines/text-davinci-003/completions';
        $api_key = get_option('chatgpt_api_key');

        //var_dump($api_key);

        //$model = 'text-davinci-003';

        // Obtener los títulos de los productos de WooCommerce
        $args = array(
            'post_type' => 'product',
            'post_status' => 'publish',
            'posts_per_page' => -1,
        );
        $products = get_posts( $args );
        $log = array(); // Inicializar el log
        $errors = array(); // Array para almacenar los errores
        $logs = array(); // Array para almacenar los logs

        return array($api_url, $api_key, $products, $log, $errors, $logs);
    }
}

if (!function_exists('gsce_crear_descripciones')) {
    function gsce_crear_descripciones() {
        // Obtener la conexión al API y los productos
        list($api_url, $api_key, $products, $log, $errors, $logs) = gsce_api_connection_and_products();

        // Procesar cada producto
        foreach ($products as $product) {
            $excerpt = $product->post_excerpt;
            $title = $product->post_title;
            $product_id = $product->ID;

            // Si el producto ya tiene descripción, no hacer nada
            if ($excerpt) {
                $logs[] = array(
                    'id' => $product_id,
                    'title' => $excerpt,
                    'status' => 'Ya tiene excerpt',
                );
                continue;
            }

            // Solicitar descripción al API de ChatGPT
            $data = array(
                'prompt' => "Actua como especialista en SEO  y crea una descripción para el producto:". $title . ".  Que siga las siguientes instrucciones: 1. Que sea de 200 palabras aproximadamente, 2. Que sea creativo, 3. que la descripción sea amigable con SEO",
                'max_tokens' => 100,
                'temperature' => 0.5,
            );
            $headers = array(
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $api_key,
            );

            $response = wp_remote_post($api_url, array(
                'method' => 'POST',
                'headers' => $headers,
                'body' => json_encode($data),
            ));

            $http_status = wp_remote_retrieve_response_code($response);

            if ($http_status != 200) {
                // Hubo un error en la solicitud al API
                $errors[] = array(
                    'id' => $product_id,
                    'title' => $excerpt,
                    'status' => 'Error en la solicitud al API',
                    'http_status' => $http_status,
                    'response' => $response,
                );
                continue;
            }

            // Actualizar descripción del producto con la respuesta del API
            $response_body = wp_remote_retrieve_body($response);
            $description = json_decode($response_body)->choices[0]->text;

            $update_post = array(
                'ID' => $product_id,
                'post_excerpt' => $description,
            );

            wp_update_post($update_post);

            $logs[] = array(
                'id' => $product_id,
                'title' => $excerpt,
                'status' => 'Descripción corta creada',
            );
        }

        // Mostrar resultados
            echo '<h2>Resultados:</h2>';
            echo '<ul>';
            foreach ($logs as $log) {
                echo '<li>Producto: ' . esc_html($log['title']) . ' (ID: ' . esc_html($log['id']) . ') - ' . esc_html($log['status']) . '</li>';
            }
            echo '</ul>';

            if (!empty($errors)) {
                echo '<h2>Errores:</h2>';
                echo '<ul>';
                foreach ($errors as $error) {
                    echo '<li>Producto: ' . esc_html($error['title']) . ' (ID: ' . esc_html($error['id']) . ') - ' . esc_html($error['status']) . '</li>';
                    echo '<ul>';
                    echo '<li>HTTP status code: ' . esc_html($error['http_status']) . '</li>';
                    echo '<li>Response: ' . esc_html($error['response']) . '</li>';
                    echo '</ul>';
                }
                echo '</ul>';
            }

    }
}


if (!function_exists('gsce_improve_descriptions')) {
    function gsce_improve_descriptions() {
        // Obtener la URL y la clave de la API
        list($api_url, $api_key, $products, $log, $errors, $logs) = gsce_api_connection_and_products();

        foreach ($products as $product) {
            $id = $product->ID;
            $title = $product->post_title;
            $description = $product->post_excerpt;
            $prompt = "Actua como especialista en SEO y mejora la siguiente descripción: " . $description . ", con las siguientes instrucciones,  1. Que tenga de 300 palabras aproximadamente y oraciones completas 2. Que la descripción sea amigable con SEO.";

            // Enviar la descripción al API de ChatGPT
            $data = array(
                'prompt' => $prompt,
                'temperature' => 0.6,
                'max_tokens' => 450,
            );

            $headers = array(
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $api_key,
            );

            $response = wp_remote_post($api_url, array(
                'method' => 'POST',
                'headers' => $headers,
                'body' => json_encode($data),
                'timeout' => 30,
            ));

            $http_status = wp_remote_retrieve_response_code($response);

            if ($http_status != 200) {
                // Hubo un error en la solicitud al API
                $errors[] = array(
                    'id' => $id,
                    'title' => $description,
                    'status' => 'Error en la solicitud al API',
                    'http_status' => $http_status,
                    'response' => $response,
                );
                continue;
            }

            $response_body = json_decode(wp_remote_retrieve_body($response), true);
            if (!isset($response_body) || !isset($response_body['choices'])) {
                $errors[] = array(
                    'id' => $id,
                    'title' => $title,
                    'message' => 'No se pudo obtener el texto generado'
                );
                continue;
            }

            $generated_text = $response_body['choices'][0]['text'];

            // Actualizar la descripción del producto
            $updated_post = array(
                'ID' => $id,
                'post_excerpt' => $generated_text,
            );
            $result = wp_update_post($updated_post);

            if ($result === 0 || $result === false) {
                $errors[] = array(
                    'id' => $id,
                    'title' => $title,
                    'message' => 'No se pudo actualizar la descripción del producto'
                );
                continue;
            }

            $logs[] = array(
                'id' => $id,
                'title' => $title,
                'generated_text' => $generated_text,
            );
            }
            // Mostrar los resultados
            echo "<h2>Log de errores:</h2>";
            if (empty($errors)) {
                echo "<p>No se encontraron errores.</p>";
            } else {
                echo "<ul>";
                foreach ($errors as $error) {
                    echo '<pre>';
                        var_dump($error);
                    echo '</pre>';

                    echo "<li>Producto #" . esc_html($error['id']) . ": " . esc_html($error['title']) . " - ";
                    if (isset($error['error'])) {
                        echo esc_html($error['error']);
                    }
                    echo "</li>";
                }
                echo "</ul>";
            }

            echo "<h2>Log de mejoras:</h2>";
            if (empty($logs)) {
                echo "<p>No se encontraron mejoras.</p>";
            } else {
                echo "<ul>";
                foreach ($logs as $log) {
                    echo "<li>Producto #" . esc_html($log['id']) . ": " . esc_html($log['title']) . "</li>";
                    echo "<blockquote>" . esc_html($log['generated_text']) . "</blockquote>";
                }
                echo "</ul>";
            }


    }
}

if (!function_exists('gsce_generar_descripciones')) {
    function gsce_generar_descripciones() {

        include( plugin_dir_path( __FILE__ ) . '../layouts/options-page-descriptions.php' );


    }
}

/**IMPORTAR PRODUCTOS */
if (!function_exists('gsce_chatgpt_import_csv')) {
    function gsce_chatgpt_import_csv() {
        if ( isset( $_POST['chatgpt_import_csv'] ) && wp_verify_nonce( $_POST['chatgpt_nonce'], 'chatgpt_import_csv' ) ) {
            if ( ! empty( $_FILES['chatgpt_csv_file']['tmp_name'] ) ) {
                $file = $_FILES['chatgpt_csv_file']['tmp_name'];
                if ( $csv = fopen( $file, 'r' ) ) {
                    $line = 0;
                    $headers = array( 'titulo', 'precio', 'sku' );
                    while ( $data = fgetcsv( $csv ) ) {
                        $line++;
                        if ( $line === 1 ) {
                            // Validar que la primera fila contenga los encabezados correctos
                            if ( $data !== $headers ) {
                                echo '<div class="notice notice-error"><p>La primera fila del archivo CSV debe contener los encabezados "Titulo", "Precio" y "SKU".</p></div>';
                                fclose( $csv );
                                return;
                            }
                            continue;
                        }
                        $title = $data[0];
                        $price = isset( $data[1] ) ? $data[1] : '';
                        $sku = isset( $data[2] ) ? $data[2] : '';
                        $post_id = wp_insert_post(
                            array(
                                'post_title' => $title,
                                'post_content' => '',
                                'post_status' => 'publish',
                                'post_type' => 'product',
                            )
                        );
                        if ( $post_id ) {
                            update_post_meta( $post_id, '_price', $price );
                            update_post_meta( $post_id, '_sku', $sku );
                        }
                    }
                    fclose( $csv );
                    echo '<div class="notice notice-success"><p>El archivo CSV se ha importado correctamente.</p></div>';
                } else {
                    echo '<div class="notice notice-error"><p>No se ha podido abrir el archivo CSV.</p></div>';
                }
            } else {
                echo '<div class="notice notice-error"><p>No se ha seleccionado ningún archivo CSV.</p></div>';
            }
        }
        ?>
        <div class="wrap">
            <h2>ChatGPT</h2>
            <h3>Importar productos desde un archivo CSV</h3>
            <p>Para importar productos desde un archivo CSV, sigue estos pasos:</p>
            <ol>
                <li>Crea un archivo CSV con los productos que deseas importar.</li>
                <li>El archivo debe contener 3 columnas: título (obligatorio), precio (opcional) y SKU (opcional).</li>
                <li>Selecciona el archivo CSV a importar.</li>
                <li>Haz clic en el botón "Importar CSV".</li>
            </ol>
            <form method="post" enctype="multipart/form-data">
                <?php wp_nonce_field( 'chatgpt_import_csv', 'chatgpt_nonce' ); ?>
                <p>
                    <label for="chatgpt_csv_file">Archivo CSV:</label>
                    <input type="file" name="chatgpt_csv_file" accept=".csv" />
                </p>
                <p class="submit">
                    <input type="submit" class="button-primary" name="chatgpt_import_csv" value="Importar CSV" />
                </p>
            </form>
        </div>
        <?php
    }
}

if (!function_exists('gsce_handle_csv')) {
    function gsce_handle_csv() {
        if ( isset( $_POST['chatgpt_import_csv_nonce'] ) && wp_verify_nonce( $_POST['chatgpt_import_csv_nonce'], 'handle_csv' ) ) {

            if ( ! empty( $_FILES['csv_file']['tmp_name'] ) ) {

                $csv_file = fopen( $_FILES['csv_file']['tmp_name'], 'r' );

                // Columnas permitidas
                $allowed_columns = array( 'titulo', 'precio', 'sku' );

                // Leer la primera fila para obtener los nombres de las columnas
                $header = fgetcsv( $csv_file );

                // Verificar que se tengan las columnas requeridas y que no haya una cuarta columna
                if ( count( $header ) <= 3 && count( array_diff( $allowed_columns, $header ) ) == 0 ) {

                    // Procesar las filas del CSV
                    while ( $row = fgetcsv( $csv_file ) ) {

                        // Obtener los valores de las columnas
                        $titulo = isset( $row[0] ) ? $row[0] : '';
                        $precio = isset( $row[1] ) ? $row[1] : '';
                        $sku = isset( $row[2] ) ? $row[2] : '';

                        // Crear el producto con los valores de las columnas
                        // ...
                    }

                    echo '<div class="notice notice-success"><p>El CSV se ha importado correctamente.</p></div>';

                } else {
                    echo '<div class="notice notice-error"><p>El CSV no tiene el formato adecuado.</p></div>';
                }

                fclose( $csv_file );
            } else {
                echo '<div class="notice notice-error"><p>No se ha seleccionado ningún archivo.</p></div>';
            }
        }
    }
}


//CREAR Y MEJORAR DESCRIPCIONES
if (!function_exists('boton_gsce_crear_descripciones')) {
    function boton_gsce_crear_descripciones() {

        if ( isset( $_POST['chatgpt_generate_descriptions'] ) && wp_verify_nonce( $_POST['chatgpt_nonce'], 'chatgpt_generate_descriptions' ) ) {
            // Ejecutar la función que genera las descripciones
            gsce_generar_descripciones();
            echo '<div class="notice notice-success"><p>Las descripciones se han generado correctamente.</p></div>';
        }
        ?>

        <div class="wrap">
            <h2>ChatGPT AI</h2>
            <p>Generar descripciones de productos:</p>
            <form method="post" action="">
                <?php wp_nonce_field( 'chatgpt_generate_descriptions', 'chatgpt_nonce' ); ?>
                <input type="hidden" name="chatgpt_generate_descriptions" value="1" />
                <p class="submit"><input type="submit" class="button-primary" value="Generar descripciones" /></p>
            </form>
        </div>
        
        <?php

    }
}

if (!function_exists('delete_all_product_excerpts')) {
    function delete_all_product_excerpts() {
        $args = array(
            'post_type' => 'product',
            'posts_per_page' => -1,
            'post_status' => 'publish',
        );
        $products = get_posts( $args );
        foreach ( $products as $product ) {
            $product->post_excerpt = '';
            wp_update_post( $product );
        }
    }
}