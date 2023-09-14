<?php
/**
 * Plugin Name:       CertiTracker
 * Plugin URI: 
 * Description:       Seguimiento de Cursos y habilitacion de Certificados
 * Version:           1.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Ramiro Navarrete
 * 
 * Require_LP_Version: 4.1.6.2
 * Requires PHP: 8.2
 * Require_LP_Certificates_Version: 4.0.2
 */

/* Interaccion con Plugin ""Learnpress", "LP-Certificates" y "Learnpress-Collection":
 * 
 * El funcionamiento se basara en comunicarse con la Base de datos $wpdb, y crear un
 * flujo de comunicacion, por ID de usuario, para que este mismo desbloquee un
 * certificado segun cuantos cursos especificos haya completado.
 * 
 * Actualmente hay 4 principales certificados
 * 
 * */
if (!defined('ABSPATH')) {
    exit;
}

// Define una constante para el directorio del plugin
define('CERTITRACKER', plugin_dir_path(__FILE__));

// Registra ganchos de activación y desactivación
register_activation_hook(__FILE__, 'certitracker_activation');
register_deactivation_hook(__FILE__, 'certitracker_deactivation');

// Acciones de activación y desactivación
function certitracker_activation() {
    global $wpdb;

    // Nombre de la Tabla
    $certitracker = $wpdb->prefix . 'lp_certitracker';
/*
    if ($wpdb->get_var("SHOW TABLES LIKE '$certitracker'") != $certitracker) {
        // Crea la Tabla
        $sql = "CREATE TABLE $certitracker (
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            nombre VARCHAR(100) NOT NULL,
            PRIMARY KEY (id)
        )";
        // garantizar la config. correctamente
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
    }*/
}

function certitracker_deactivation() {
    global $wpdb;

    /*
    $certitracker = $wpdb->prefix . 'lp_certitracker';
    $wpdb->query("DROP TABLE IF EXISTS $certitracker");
    */
}

// Agrega ganchos y funciones adicionales para tu plugin aquí

// Ejemplo de agregar un shortcode
add_shortcode('mi_shortcode', 'funcion_mi_shortcode');

function funcion_mi_shortcode($atts) {
    // Lógica de tu shortcode aquí
    return 'Este es el contenido del shortcode';
}

// Ejemplo de agregar un filtro
add_filter('the_content', 'filtro_personalizado');

function filtro_personalizado($content) {
    // Modifica el contenido del artículo/post aquí
    return $content;
}

// Agregar un panel en el lado izquierdo del panel de administración
function certitracker_menu_page() {
    add_menu_page(
        'Tu Plugin',       // Título en la página del menú
        'Certitracker',       // Título en el menú
        'manage_options',  // Capacidad requerida para ver el menú
        'tu-plugin-menu',  // Identificador único de la página
        'certitracker_page_content', // Función que muestra el contenido de la página
        'dashicons-admin-generic'    // Icono en el menú (puedes cambiarlo)
    );

    add_submenu_page(
        'tu-plugin-menu',         // Identificador del menú principal
        'Submenú de Tu Plugin',   // Título del submenú
        'Dashboard',   // Título del submenú
        'manage_options',         // Capacidad requerida para ver el submenú
        'tu-plugin-submenu',      // Identificador único del submenú
        'certitracker_subpage_content' // Función que muestra el contenido del submenú
    );
}
// Función para mostrar el contenido del panel
function certitracker_page_content() {
    // Puedes agregar aquí el contenido que deseas mostrar en tu panel
    echo '<div class="wrap">';
    echo '<h2>Certitracker</h2>';
    echo '<p>Los certificados se renderizaran en el Perfil del alumno</p>';
    echo '</div>';
}

// Función para mostrar el contenido del submenú flotante
function certitracker_subpage_content() {
    ob_start(); // Iniciar el búfer de salida

    // Generar contenido HTML
    ?>
    <div class="wrap">
        <style>
            /* Agrega estilos CSS para el fondo blanco */
            body {
                background-color: #fff;
            }
        </style>
        <h2>Submenú Dashboard</h2>
        <p>Panel de administracion</p>
        <header>
            <h1>¡Dashboard Certitracker!</h1>
        </header>
        <section>
            <p>Aca no se van a renderizar los certificados, eso sucederá en el perfil del Alumno al completar dichos cursos especificos (Actualmente 4 certificados)</p>
            <!-- Puedes agregar más contenido aquí -->
        </section>
    </div>
    <?php

    // Capturar el contenido del búfer en una variable
    $content = ob_get_clean();

    // Imprimir el contenido
    echo $content;
}


// Registrar el panel en el hook 'admin_menu'
add_action('admin_menu', 'certitracker_menu_page');

/**
 * -----------------------------------------------------------------------------
 * Logica Base, lo recomendable es importar recursos de otros plugins y comenzar
 * a trabajar.
 */

class LP_Certitracker {

    /**
	 * Certificate post ID
	 *
	 * @var int
	 */
	protected $_id = 0;

    /**
	 * LP_Certificate constructor.
	 *
	 * @param int $user_id
	 * @param int $course_id
	 * @param int $certificate_id
	 */
	public function __construct( $user_id, $course_id = 0, $certificate_id = 0 ) {

        /**
     * 
     * wp_learnpress_user_items
     * Desde la columna 'status', se puede manejar el estado de un curso.
     */

    }

}

?>