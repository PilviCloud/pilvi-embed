<?php
if ( ! defined( 'ABSPATH' ) ) exit;
/**
 * Fired when the plugin is uninstalled.
 *
 * When populating this file, consider the following flow
 * of control:
 *
 * - This method should be static
 * - Check if the $_REQUEST content actually is the plugin name
 * - Run an admin referrer check to make sure it goes through authentication
 * - Verify the output of $_GET makes sense
 * - Repeat with other user roles. Best directly by using the links/query string parameters.
 * - Repeat things for multisite. Once for a single site in the network, once sitewide.
 *
 * This file may be updated more in future version of the Boilerplate; however, this is the
 * general skeleton and outline for how the file should work.
 *
 * For more information, see the following discussion:
 * https://github.com/tommcfarlin/WordPress-Plugin-Boilerplate/pull/123#issuecomment-28541913
 *
 * @link       http://pilvi.com/
 * @since      1.0.0
 *
 * @package    Pilvi_Embed
 */

// If uninstall not called from WordPress, then exit.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}
// deletes plugins options when uninstalled
$all_plugin_options = array(
	'pilvi_emb_session_host',
	'pilvi_emb_api_host',
	'pilvi_emb_language',
	'pilvi_emb_prices',
	'pilvi_emb_compare',
	'pilvi_emb_https',
	'js_pilvi_emb_version',
	'js_pilvi_emb_session_host',
	'js_pilvi_emb_api_host',
	'js_pilvi_emb_https',
	'js_pilvi_emb_language',
	'js_pilvi_emb_prices',
	'js_pilvi_emb_compare',
	'pilvi_emb_version',
	'pilvi_embed_plugin_version'
);	


foreach($all_plugin_options as $optionName) {
    delete_option($optionName);
}
