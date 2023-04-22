=== Plugin Name ===
Contributors: Edgardo Tupiño
Tags: wordpress, plugin, ecommerce
Requires at least: 1.0.0
Tested up to: 1.0.0
Stable tag: 1.0.0
License: GPL-2.0+
License URI: https://www.gnu.org/licenses/gpl-2.0.txt

Short Description: Plugin para WordPress que permite generar y mejorar descripciones automaticas para productos de WooCommerce, con conexión a ChatGPT (OpenAI).

== Descripción ==

Este plugin ha sido diseñado para mejorar las descripciones de tus productos de forma rápida y eficiente, utilizando la potente inteligencia artificial de ChatGPT de OpenAI. 
Con este plugin, podrás generar descripciones de productos en segundos y optimizar las ya existentes, ahorrando tiempo y aumentando la calidad de tus contenidos.

Para utilizar el plugin, simplemente instálalo y actívalo. Verás una nueva opción en el menú de WordPress llamada "Descripciones AI". 
Allí podrás generar nuevas descripciones, mejorar las ya existentes y borrarlas en caso de ser necesario.

Si tienes preguntas o necesitas ayuda con el plugin, no dudes en contactar con nosotros a través de la opción de contacto que ofrecemos.

¡Esperamos que disfrutes de nuestro plugin de descripciones de productos!

== Dependencia de un servicio de terceros ==

Importante: Este complemento depende de un servicio de terceros, OpenAI ChatGPT API, para funcionar correctamente. El plugin actúa como intermediario entre tu sitio web de WordPress y la API de ChatGPT. Por lo tanto, es fundamental que tengas en cuenta que la disponibilidad y el rendimiento del complemento están directamente relacionados con el servicio proporcionado por OpenAI.

En circunstancias en las que el servicio de OpenAI ChatGPT API no esté disponible, el plugin no podrá generar ni mejorar las descripciones de los productos.

La API https://api.openai.com/v1/engines/text-davinci-003/completions es un punto de acceso proporcionado por OpenAI para interactuar con el motor de inteligencia artificial text-davinci-003. Este motor forma parte de la familia de motores de ChatGPT y es conocido por su capacidad para generar contenido de alta calidad y coherente.

El propósito principal de esta API es generar texto completado o continuaciones de texto a partir de un prompt (texto de entrada) proporcionado por el usuario. Estas completions pueden ser utilizadas en una amplia gama de aplicaciones, como la generación automática de contenido, la creación de resúmenes, la respuesta a preguntas, la traducción de idiomas y mucho más.

Al utilizar esta API, puedes enviar varios datos y parámetros para personalizar y controlar la generación de texto. Algunos de los parámetros más comunes incluyen:

prompt: El texto de entrada o prompt que le proporcionas al modelo. El modelo generará el contenido basado en este prompt.
max_tokens: El número máximo de tokens (palabras o fragmentos de palabras) que deseas en la respuesta generada.
temperature: Un valor que controla la aleatoriedad del texto generado. Un valor más alto (por ejemplo, 1.0) dará lugar a respuestas más variadas y creativas, mientras que un valor más bajo (por ejemplo, 0.1) generará respuestas más conservadoras y coherentes.
top_p: Un valor que controla la diversidad del texto generado al limitar la selección de tokens a aquellos con una probabilidad acumulada igual o inferior al valor especificado.
n: El número de completions independientes que deseas generar a partir del mismo prompt.
Al ajustar estos parámetros y otros, puedes personalizar y adaptar las respuestas generadas por la API para satisfacer tus necesidades específicas. Ten en cuenta que el uso de esta API está sujeto a las políticas de uso y privacidad de OpenAI, y es importante asegurarse de que cualquier dato enviado cumpla con estas políticas.


== Enlaces útiles ==    

Para obtener más información sobre OpenAI ChatGPT API, visita: https://beta.openai.com/docs/
Política de privacidad de OpenAI: https://platform.openai.com/docs/privacy-policy
Ten en cuenta que los datos enviados a través de este plugin son tratados según la política de privacidad de OpenAI.


== Funcionalidades ==

- Generación automática de descripciones de productos: el plugin utiliza inteligencia artificial para generar descripciones de productos basadas en la información disponible.
- Mejora de las descripciones de los productos: el plugin también ofrece una función para mejorar las descripciones de los productos existentes, permitiéndote editar y perfeccionar las descripciones para que se ajusten mejor a tus necesidades.
- Eliminación masiva de resúmenes de productos: si necesitas borrar todas las descripciones de tus productos de tu sitio, este plugin te ofrece una opción de eliminación masiva para que puedas hacerlo de manera rápida y sencilla.

== Instalación ==

1. Upload the plugin files to the `/wp-content/plugins/` directory, or install the plugin through the WordPress plugins screen directly.
2. Activate the plugin through the 'Plugins' screen in WordPress.
3. Use the [shortcode] shortcode to embed your plugin in your posts or pages.

== Preguntas frecuentes ==

¿Cómo funciona el botón "Crear descripciones"?
El botón "Crear descripciones" te permite generar descripciones automáticamente para los productos que no tienen una descripción definida.

¿Qué hace el botón "Mejorar descripciones"?
El botón "Mejorar descripciones" toma las descripciones existentes y las mejora utilizando un algoritmo de procesamiento de lenguaje natural.

¿Qué hace el botón "Borrar descripciones"?
El botón "Borrar descripciones" elimina las descripciones existentes de los productos seleccionados.

¿A qué se refieren las descripciones generadas y mejoradas?
Las descripciones se refieren al campo "post_excerpt" de los productos de WooCommerce.

== Changelog ==

= 1.0.0 =
* Initial release

== Upgrade Notice ==

= 1.0.0 =
Initial release

== Screenshots ==

[Some screenshots of your plugin]

== Credits ==

- ChatGPT 3.5
- OpenAI
- jQuery

== Contact ==

If you have any questions or concerns, please email edgardo@tupino.com
-