<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://pilvi.com/
 * @since      1.0.0
 *
 * @package    Pilvi_Embed
 * @subpackage Pilvi_Embed/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Pilvi_Embed
 * @subpackage Pilvi_Embed/admin
 * @author     Oleg Soldatikhine <oleg@pilvi.com>
 */
class Pilvi_Embed_Admin {

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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/pilvi-embed-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/pilvi-embed-admin.js', array( 'jquery' ), $this->version, false );

	}
	
	/* adding menu page to dashboard */
	
	public function pilvi_emb_menu_page(){
        
		add_menu_page( 'Pilvi Embed page', 'Pilvi embed', 'manage_options', 'Pilvi', array($this, 'display_dash_board_page'),plugins_url( 'pilvi-embed/images/icon.png'),'3.0');
	
	}
	
	public function display_dash_board_page(){
		include(__DIR__ . '/admin-page-layout.php');
		include(__DIR__ . '/admin-validate-url.php');
	
	}

	/* functios for pilvi embed tiny mce buttn */
	
	public function enqueue_plugin_scripts($plugin_array){
	
		//enqueue TinyMCE plugin script with its ID.
		$plugin_array["pilvi_button_plugin"] =  plugin_dir_url(__FILE__) . "js/pilvi-embed-admin.js";
		return $plugin_array;
	
	}
	
	public function register_buttons_editor($buttons){
    
		//register buttons with their id.
		array_push($buttons, "pilvi_button_plugin");
		return $buttons;
	
	}
	
}
