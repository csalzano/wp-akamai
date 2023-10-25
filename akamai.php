<?php
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://developer.akamai.com
 * @since             0.2.0
 * @package           Akamai
 * @author            Davey Shafik <dshafik@akamai.com>
 *
 * @wordpress-plugin
 * Plugin Name:       Akamai Cache Purge
 * Plugin URI:        http://github.com/akamai/wp-akamai
 * Description:       Integrates with Akamai to purge CDN cache when content is created, updated, or deleted.
 * Version:           0.6.1
 * Author:            Akamai Technologies
 * Author URI:        https://developer.akamai.com
 * License:           GPLv3
 * License URI:       https://www.gnu.org/licenses/gpl-3.0.txt
 * Text Domain:       akamai
 */

// If this file is called directly, abort.
defined( 'ABSPATH' ) || exit;

if ( ! defined( 'AKAMAI_MIN_PHP' ) ) {
	define( 'AKAMAI_MIN_PHP', '5.3' );
}

if ( ! function_exists( 'activate_akamai' ) ) {
	/**
	 * The code that runs during plugin activation.
	 * This action is documented in includes/class-akamai-activator.php
	 */
	function activate_akamai() {
		require_once plugin_dir_path( __FILE__ ) . 'includes/class-akamai-activator.php';
		Akamai_Activator::activate();
	}
	register_activation_hook( __FILE__, 'activate_akamai' );
}

if ( ! function_exists( 'deactivate_akamai' ) ) {
	/**
	 * The code that runs during plugin deactivation.
	 * This action is documented in includes/class-akamai-deactivator.php
	 */
	function deactivate_akamai() {
		require_once plugin_dir_path( __FILE__ ) . 'includes/class-akamai-deactivator.php';
		Akamai_Deactivator::deactivate();
	}
	register_deactivation_hook( __FILE__, 'deactivate_akamai' );
}

if ( ! function_exists( 'run_akamai' ) ) {
	require_once 'vendor/akamai-open/edgegrid-auth/src/Authentication.php';
	require_once 'vendor/akamai-open/edgegrid-auth/src/Authentication/Timestamp.php';
	require_once 'vendor/akamai-open/edgegrid-auth/src/Authentication/Nonce.php';
	require_once 'vendor/akamai-open/edgegrid-auth/src/Authentication/Exception.php';
	require_once 'vendor/akamai-open/edgegrid-auth/src/Authentication/Exception/ConfigException.php';
	require_once 'vendor/akamai-open/edgegrid-auth/src/Authentication/Exception/SignerException.php';
	require_once 'vendor/akamai-open/edgegrid-auth/src/Authentication/Exception/SignerException/InvalidSignDataException.php';
	/**
	 * The core plugin class that is used to define internationalization,
	 * admin-specific hooks, and public-facing site hooks.
	 */
	require plugin_dir_path( __FILE__ ) . 'includes/class-akamai.php';

	/**
	 * Begins execution of the plugin.
	 *
	 * Since everything within the plugin is registered via hooks,
	 * then kicking off the plugin from this point in the file does
	 * not affect the page life cycle.
	 *
	 * @since    0.1.0
	 */
	function run_akamai() {
		$plugin = new Akamai();
		$plugin->run();
	}
	run_akamai();
}
