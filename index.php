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
    }
}

function certitracker_deactivation() {
    global $wpdb;

    $certitracker = $wpdb->prefix . 'lp_certitracker';
    $wpdb->query("DROP TABLE IF EXISTS $certitracker");
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