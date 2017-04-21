<?php

/**
 * Fired during plugin activation
 *
 * @link       http://pilvi.com/
 * @since      1.0.0
 *
 * @package    Pilvi_Embed
 * @subpackage Pilvi_Embed/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Pilvi_Embed
 * @subpackage Pilvi_Embed/includes
 * @author     Oleg Soldatikhine <oleg@pilvi.com>
 */
class Pilvi_Embed_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		
		update_option('pilvi_embed_plugin_version', PILVI_EMBED_VERSION);
		
		$version = get_option('pilvi_emb_version');
		
		if($version == ""){
			update_option( 'pilvi_emb_version', "stable" ); 
			update_option( 'pilvi_emb_api_host', "saas.api.service.pilvi.com"  ); 
			update_option( 'pilvi_emb_https', "true" );
			update_option( 'pilvi_emb_session_host', "" );
			update_option( 'pilvi_emb_language', "" );
			update_option( 'pilvi_emb_prices', "" ); 
			update_option( 'pilvi_emb_compare', "" );
		
		}	
		

	}

}
