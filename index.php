<?php
/**
 * Plugin Name: GTP Suite AI Content Engine
 * Plugin URI: https://andina-digital.com/plugins
 * Description: Un plugin para generar y mejorar descripciones de productos automáticamente utilizando la inteligencia artificial de ChatGPT.
 * Version: 1.0
 * Author: Edgardo Tupiño
 * Author URI: https://edgardo.tupino.com/
 * Text Domain: gpt-suite-ai-content-engine
 * Domain Path: /languages
 * License: GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 *
 * @package Products_Descriptions_ChatGPT
 */

// Aquí irá tu código para el plugin

defined( 'ABSPATH' ) || exit;


require_once plugin_dir_path( __FILE__ ) . 'includes/functions.php';

require_once plugin_dir_path( __FILE__ ) . 'includes/options-page.php';

function gsce_enqueue_styles() {
    
    if ( ! wp_script_is( 'jquery', 'enqueued' ) ) {
        wp_enqueue_script( 'jquery' );
    }
    
    wp_register_style( 'gpt-suite-ai-content-eng-style', plugins_url( 'assets/css/style.css', __FILE__ ) );
    
    wp_enqueue_style( 'gpt-suite-ai-content-eng-style' );

    wp_enqueue_script('gpt-suite-ai-content-eng-script', plugin_dir_url(__FILE__) . 'assets/js/main.js', array('jquery'), '1.0', true);

}

add_action( 'admin_enqueue_scripts', 'gsce_enqueue_styles' );