<div class="wrap">
  <h2>Configuración de API Key</h2>
  <?php //var_dump(get_option('chatgpt_api_key')); ?>
    <p>Pega aqui el API key que debes gnerar en Open AI, esto es necesario para que el servicio funcione.</p>
  <form method="post" action="<?php echo admin_url( 'admin-post.php' ); ?>">
    <input type="hidden" name="action" value="save_api_key">

    <label for="api_key">API Key:</label>
    <input type="text" name="api_key" id="api_key" value="<?php echo esc_attr( get_option( 'chatgpt_api_key' ) ); ?>" />

    <?php wp_nonce_field( 'save_api_key', 'chatgpt_api_key_nonce' ); ?>

    <input type="submit" value="Guardar" class="button-primary" />
  </form>
</div>
<br>
<hr>
<div class="wrap">
    <h1>Generador de descripciones de los productos</h1>
    <p>Usa esta opción solo si tus productos no tienen descripción. Recuerda que puedes subirlos usando el importador de productos que esta dentro de las opciones. Se va a generar una descripción de 250 palabras optimizada para SEO.</p>
    <p> <strong>   Importante:</strong> Es posible que el proceso tarde varios minutos, se paciente, la conexión dependerá de muchos factores.</p>
    
    <form method="post">
        <h2>Crear descripciones</h2>
        <input type="hidden" name="create_descriptions" value="1">
        <?php wp_nonce_field( 'create_descriptions_nonce', 'create_descriptions_nonce_field' ); ?>
        <p><input type="submit" value="Generar descripciones" class="button button-primary"></p>
    </form>
    
    <form method="post">
        <h2>Mejorar descripciones</h2>
        <p>Usa esta opción para mejorar la descripción de tus productos. Tendrás una descripción de 300 palabras optimizada para SEO y generada por Inteligencia Artificial - ChatGPT</p>
        <p><strong>   Importante:</strong> Es posible que el proceso tarde varios minutos, se paciente, la conexión dependerá de muchos factores.</p>
        <input type="hidden" name="improve_descriptions" value="1">
        <?php wp_nonce_field( 'improve_descriptions_nonce', 'improve_descriptions_nonce_field' ); ?>
        <p><input type="submit" value="Mejorar descripciones" class="button button-primary"></p>
    </form>
    
</div>

<hr>

<h2>¿Estas experimentando algun error?</h2>

<p>Porfavor puedes reportarlo usando este formulario de google aqui: <a href="https://forms.gle/Db2oFmbttqrXChMr7" target="_blank">https://forms.gle/Db2oFmbttqrXChMr7</a></p>


<br>
<hr>
<br>

<div class="wrap">

    <div class="section section-danger">

    <h2>ZONA DE PELIGRO</h2>
    <h4> Solo utiliza esta funcionalidad si necesitas borrar todas las descripciones de los productos de tu sitio. El proceso no es reversible. Demora en función a la cantidad de productos que tengas.</h4>

        <form id="deleteAllExcerpts" method="post">
            <input type="hidden" name="delete_product_excerpts" value="1" />
            <p><input type="submit" value="Eliminar todos los resúmenes de productos" class="button button-primary" /></p>
        </form>

    </div>

</div>


<?php
	if ( isset( $_POST['delete_product_excerpts'] ) && $_POST['delete_product_excerpts'] == 1 ) {
		delete_all_product_excerpts();
		echo '<p>Todos los resúmenes de productos han sido eliminados.</p>';
	}



    if (isset($_POST['create_descriptions']) && wp_verify_nonce($_POST['create_descriptions_nonce_field'], 'create_descriptions_nonce')) {
        pdcgpt_crear_descripciones();
    } elseif (isset($_POST['improve_descriptions']) && wp_verify_nonce($_POST['improve_descriptions_nonce_field'], 'improve_descriptions_nonce')) {
        pdcgpt_improve_descriptions();
    }


?>


