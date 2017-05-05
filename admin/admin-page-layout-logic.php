<?php
if ( ! defined( 'ABSPATH' ) ) exit;

	$user = wp_get_current_user();
	$allowed_roles = array('editor', 'administrator', 'author', 'contributor');
	
	if (!array_intersect($allowed_roles, $user->roles)){
		exit("You have no right to be here");
	}	

	/* include version array */	
	require_once("version_parameters_array.php");
	$compare = get_option ('pilvi_emb_compare');
	$https = get_option ('pilvi_emb_https');
	/* feching version from database */
	$version = get_option('pilvi_emb_version');
	/*if version is latest feching array(0) */
	
	/* if post select */
	if(isset($_POST["select"])){
	
		$version = sanitize_text_field( $_POST['version'] );
		
		/* if version is latest code fechs first key from the array */
		
		if($_POST["version"]=="latest" ){
			$opt_version = 'pilvi_emb_version';
			update_option( $opt_version, "latest" );
			reset($version_parameters);
			$version = key($version_parameters);
		}else{
			
		/* updating chosen version */
			$opt_version = 'pilvi_emb_version';
			update_option( $opt_version, $version );
		}	
			/* if version not found from array */
			if(!isset($version_parameters[$version])){
					print "version not found";
			}else{
				/*getting values from array*/
				$url = $version_parameters[$version]['session_host'];
				$apiUrl = $version_parameters[$version]['api_host'];
				$optLanguage = $version_parameters[$version]['opt_language'];
				$optPrices = $version_parameters[$version]['opt_prices'];
				$compare = $version_parameters[$version]['opt_compare'];
				$https = $version_parameters[$version]['https'];
				/* adding keys for a table */
				$opt_session_host = 'pilvi_emb_session_host';
				$opt_api_host = 'pilvi_emb_api_host';
				$opt_language = 'pilvi_emb_language';
				$opt_prices = 'pilvi_emb_prices';
				$opt_compare = 'pilvi_emb_compare';
				$opt_https = 'pilvi_emb_https';
				
				/* comparing array keys to "full" array */	
				$result = array_diff_assoc($all_parameters, $version_parameters[$version]);
					
					
				/* loops result of arrays and updates missing values to "" */
					foreach($result as $key => $value){
						if($key == "session_host"){
							update_option( $opt_session_host, "" );
						}elseif($key == "api_host"){	
							update_option( $opt_api_host, "" );
						}elseif($key == "opt_language"){	
							update_option( $opt_language, "" );	
						}elseif($key == "opt_prices"){	
							update_option( $opt_prices, "" );
						}elseif($key == "opt_compare"){
							update_option( $opt_compare, "" );
						}elseif($key == "https"){
							update_option( $opt_https, "" );
						}else{
							echo "failed";
						}	
							
					}	

			} 
				
	
	}
	/* feching first key from array */
	reset($version_parameters);
	/* used in layout.php row18 */
	$last_key = key($version_parameters);
	
	/* if settings / save / is pressed */
	if(isset($_POST["change"])){
		
		$url =  sanitize_text_field( $_POST['url'] ); 
		$apiUrl = sanitize_text_field( $_POST['site'] );  						
		$optPrices = sanitize_text_field( $_POST['prices'] ); 
		$optLanguage = sanitize_text_field( $_POST['language'] ); 
		$compare = sanitize_text_field( $_POST['compare'] ); 
		$https = sanitize_text_field( $_POST['https'] );
		
		
		/* option names */
		
		$opt_session_host = 'pilvi_emb_session_host';
		$opt_api_host = 'pilvi_emb_api_host';
		$opt_language = 'pilvi_emb_language';
		$opt_prices = 'pilvi_emb_prices';
		$opt_compare = 'pilvi_emb_compare';
		$opt_https = 'pilvi_emb_https';
		
		/* updating options */
		
		update_option( $opt_session_host, $url );
		update_option( $opt_api_host, $apiUrl );
		update_option( $opt_language, $optLanguage );
		update_option( $opt_prices, $optPrices  ); 
		update_option( $opt_compare, $compare );
		update_option( $opt_https, $https );
			
	}

	/* default settings */
	if(isset($_POST["default"])){
		
		update_option( 'pilvi_emb_version', "stable" ); 
		update_option( 'pilvi_emb_api_host', "saas.api.service.pilvi.com"  ); 
		update_option( 'pilvi_emb_https', "true" );
		
		update_option( 'pilvi_emb_session_host', "" );
		update_option( 'pilvi_emb_language', "" );
		update_option( 'pilvi_emb_prices', "" ); 
		update_option( 'pilvi_emb_compare', "" );

			
	}	
	
	/* getting price value */
    $prices = get_option('pilvi_emb_prices');
	
	if($prices=="VAT_INCL_VAT_EXCL"){
		$VAT_INCL_VAT_EXCL = "checked=\"checked\"";
	}elseif($prices=="VAT_EXCL_VAT_INCL"){
		$VAT_EXCL_VAT_INCL = "checked=\"checked\"";
	}elseif($prices=="VAT_EXCL"){
		$VAT_EXCL = "checked=\"checked\"";
	}elseif($prices=="VAT_INCL"){
		$VAT_INCL = "checked=\"checked\"";
	}	
	
	/* getting compare value */
	$compare = get_option ('pilvi_emb_compare');
	
	if($compare=="true"){
		$true_compare = "checked=\"checked\"";
	}elseif($compare == "false"){
		$false_compare = "checked=\"checked\"";
	}	
	
	/* getting https value */
	$https = get_option ('pilvi_emb_https');
	
	if($https=="true"){
		$true_https = "checked=\"checked\"";
	}elseif($https == "false"){
		$false_https = "checked=\"checked\"";
	}	

	/* feching version from database */
	$version = get_option('pilvi_emb_version');

	/* telling user taht there is a new version */
	if($version != "latest"){
		$remind = "<br>New version is available.<br>";
	}
	
	
?>