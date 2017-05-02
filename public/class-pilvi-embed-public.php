<?php
if ( ! defined( 'ABSPATH' ) ) exit;
/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://pilvi.com/
 * @since      1.0.0
 *
 * @package    Pilvi_Embed
 * @subpackage Pilvi_Embed/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Pilvi_Embed
 * @subpackage Pilvi_Embed/public
 * @author     Oleg Soldatikhine <oleg@pilvi.com>
 */
class Pilvi_Embed_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Pilvi_Embed_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Pilvi_Embed_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/pilvi-embed-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Pilvi_Embed_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Pilvi_Embed_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		wp_enqueue_script( pilvi_embed_script, 'https://embed.pilvi.com/'. get_option('js_pilvi_emb_version').'/pilvi-embedded.js', array( 'jquery' ), false, true );
		
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/pilvi-embed-public.js', array( 'jquery' ), $this->version, true );
		
		$admin_variables_for_public_js = array(
			'VERSION'      => get_option ('js_pilvi_emb_version'),
			'SESSION_HOST' => get_option ('js_pilvi_emb_session_host'),
			'API_HOST'     => get_option ('js_pilvi_emb_api_host'),
			'HTTPS'        => get_option ('js_pilvi_emb_https'),
			'LANGUAGE'     => get_option ('js_pilvi_emb_language'),
			'PRICES'       => get_option ('js_pilvi_emb_prices'),
			'COMPARE'      => get_option ('js_pilvi_emb_compare')
			
		);
		
		wp_localize_script( $this->plugin_name, 'php_variables', $admin_variables_for_public_js );
	
	}
	
	/* adding shortcodes and shortcode functions */
	
	public function add_public_short_code(){
		
		add_shortcode( 'pilvi_embed_product_card', array( $this, 'pilvi_embed_product_card' ));
		add_shortcode( 'pilvi_embed_product_card_group', array($this, 'pilvi_embed_product_card_group' ));
		
	}	
	
	// [pilvi_embed_product_card id="add-id" prices="add-prices"]
	public function pilvi_embed_product_card($atts){
		
		 $a = shortcode_atts( array('id' => 'null','prices' => 'null'), $atts );
	
		$id= sanitize_text_field($a['id']);
		$prices= sanitize_text_field($a['prices']);
		
		if($prices != "null"){
		
			return "<span data-pilvi-emb-pc-id=".$id." data-pilvi-emb-pc-prices=".$prices."></span>";
		
		}else{

			return "<span data-pilvi-emb-pc-id=".$id."></span>";
		
		}	
		
	}	
	
		// [pilvi_embed_product_card_group id="add-id" prices="add-prices" compare="off"]
	function pilvi_embed_product_card_group( $atts ) {
		$a = shortcode_atts( array('id' => 'something','prices' => 'null','compare' => 'default'), $atts );
		
		/* getting users values from shortcode */
		
			$id= sanitize_text_field($a['id']);
			$prices= sanitize_text_field($a['prices']);
			$compare= sanitize_text_field($a['compare']);
							
		/* making shure that only "true" or "false" have been used */
		
			if($compare == "true" || $compare == true ){
				$compare = true;
			}elseif($compare == "false" || $compare == false){
				$compare = false;
			}else{
				print "Compare value must be true or false.";	
			}
			
		if($prices == "null" AND $compare == "default"){
			
			return "<span data-pilvi-emb-pcg-id=".$id."></span>";
		
		}elseif($prices != "null" AND $compare != "default"){
			
			return "<span data-pilvi-emb-pcg-id=".$id." data-pilvi-emb-pc-prices=".$prices." data-pilvi-emb-pcg-compare=".$compare."></span>";
		
		}elseif($prices != "null" AND $compare == "default"){
			
			return "<span data-pilvi-emb-pcg-id=".$id." data-pilvi-emb-pc-prices=".$prices."></span>";
		
		}elseif($prices == "null" AND $compare != "default"){
			
			return "<span data-pilvi-emb-pcg-id=".$id." data-pilvi-emb-pcg-compare=".$compare."></span>";
		
		}
	
	
	}
		
		
}