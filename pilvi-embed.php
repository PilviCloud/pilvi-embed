<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://pilvi.com/
 * @since             1.0.0
 * @package           Pilvi_Embed
 *
 * @wordpress-plugin
 * Plugin Name:       Pilvi embed
 * Plugin URI:        http://developer.pilvi.com/docs/embeds/plugins/wordpress
 * Description:       Shortcode plugin
 * Version:           1.0.2
 * Author:            Pilvi
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       pilvi-embed
 * Domain Path:       /languages
 */

 // Current version number
if (!defined('PILVI_EMBED_VERSION')){
	define('PILVI_EMBED_VERSION', '1.0.2');
}
 
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-pilvi-embed-activator.php
 */
function activate_pilvi_embed() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-pilvi-embed-activator.php';
	Pilvi_Embed_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-pilvi-embed-deactivator.php
 */
function deactivate_pilvi_embed() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-pilvi-embed-deactivator.php';
	Pilvi_Embed_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_pilvi_embed' );
register_deactivation_hook( __FILE__, 'deactivate_pilvi_embed' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-pilvi-embed.php';


function pilvi_emb_check_version() {
	if (PILVI_EMBED_VERSION !== get_option('pilvi_embed_plugin_version')){
		activate_pilvi_embed();
	}	
}
add_action('plugins_loaded', 'pilvi_emb_check_version');

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_pilvi_embed() {

	$plugin = new Pilvi_Embed();
	$plugin->run();

}
run_pilvi_embed();
