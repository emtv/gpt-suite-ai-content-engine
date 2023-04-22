<div class="wrap">
    <h1>WooCommerce Descripciones Automáticas con AI</h1>
    <p>Bienvenido al Plugin de Descripciones con intelgencia artificial. Este plugin te ayuda a generar descripciones automáticamente para tus productos de WooCommerce. 
        Usamos el servicio de ChatGPT, enviamos la información y este servicio responde con efectividad.
    </p>
    <p>A continuación se explican las funcionalidades disponibles.</p>
    <h2>Crear Descripciones</h2>
    <p>Para crear descripciones para tus productos, simplemente haz clic en el botón "Crear descripciones". Esto generará descripciones para todos los productos que aún no tienen una descripción.</p>
    <h2>Mejorar Descripciones</h2>
    <p>Si ya tienes descripciones para tus productos, puedes hacer clic en el botón "Mejorar descripciones". Esto utilizará la API de IA para mejorar las descripciones existentes y generar nuevas descripciones si es necesario. Ten en cuenta que esto puede tomar algún tiempo si tienes muchos productos.</p>
    <h2>Borrar Descripciones</h2>
    <p>Si deseas borrar todas las descripciones de tus productos, simplemente haz clic en el botón "Borrar descripciones". Esto eliminará todas las descripciones de todos los productos.</p>
    <p>Todas las descripciones generadas se refieren al campo "post_excerpt" del producto. Asegúrate de tener este campo disponible para que las descripciones puedan ser agregadas correctamente.</p>
    <hr>
    <h1>Importar CSV Productos</h1>
    <p>Esta funcionalidad permite importar productos a tu sitio web desde un archivo CSV.</p>
    <p>Para poder utilizar esta función sigue los siguientes pasos:</p>
    <ol>
        <li>Prepara un archivo CSV que contenga la información de los productos que deseas importar. Asegúrate de que cumpla con el formato requerido.</li>
        <li>Puedes usar este <a href="https://docs.google.com/spreadsheets/d/1ZiEUWnj27JjfwhR5ftK1UQBcFymKtHizVj7juyC-iDM/edit?usp=sharing" target="_blank">archivo de Google Drive para poder tener el template</a>.</li>
        <li>Accede al dashboard de WordPress y haz clic en "Importar CSV" en el menú de la izquierda.</li>
        <li>Selecciona el archivo CSV que deseas importar y haz clic en "Cargar archivo".</li>
        <li>Verifica que la información del archivo CSV sea correcta y haz clic en "Importar productos".</li>
        <li>Espera a que el proceso de importación termine. Dependiendo del tamaño del archivo CSV, esto puede tomar unos minutos.</li>
        <li>Verifica que los productos hayan sido importados correctamente.</li>
    </ol>
    <p>Recuerda que esta función puede ser peligrosa si no se utiliza correctamente. Asegúrate de tener una copia de seguridad de tu sitio web antes de utilizarla.</p>


    <a href="<?php echo esc_url( admin_url( 'admin.php?page=chatgpt_general_settings' ) ); ?>" class="page-title-action button-primary">Ir a Generar Descripciones</a>

</div>
<br>
<hr>
<br>

<div class="wrap">
    <h2>Generación de API Key para ChatGPT</h2>
    <p>Para utilizar las funciones del plugin ChatGPT es necesario contar con una API Key válida proporcionada por OpenAI.</p>
    <p>A continuación se detallan los pasos para generar una API Key:</p>
    <ol>
        <li>Ingresa a la página de <a href="https://beta.openai.com/signup/" target="_blank">registro</a> de OpenAI.</li>
        <li>Crea una cuenta o inicia sesión si ya tienes una.</li>
        <li>Dirígete a la sección de <a href="https://platform.openai.com/account/api-keys" target="_blank">API Keys</a> y haz clic en el botón "Create API Key".</li>
        <li>Copia la API Key generada y pégala en el campo correspondiente en la sección de opciones del plugin.</li>
    </ol>
    <p>Una vez generada y guardada la API Key, podrás utilizar las funciones de ChatGPT sin problemas.</p>
</div>
