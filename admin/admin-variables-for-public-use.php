<?php
if ( ! defined( 'ABSPATH' ) ) exit;
	include "version_parameters_array.php";
	/* This file will prepeare all needable wariables for public js code 
	   This file will save all needable variables to wp options */
	
	/* getting version from database */
	/* if version is latest, feching version key from array */
	
	
	$js_version = get_option('pilvi_emb_version');
    if($js_version == "latest"){
		reset($version_parameters);
		$js_version = key($version_parameters);
	}

	/* feching prises and changing them for javascript */
	
	$new_price = get_option('pilvi_emb_prices'); 

	if($new_price=="VAT_INCL_VAT_EXCL"){
	$js_price = "['VAT_INCL','VAT_EXCL']";
	}elseif($new_price=="VAT_EXCL_VAT_INCL"){	
	$js_price = "['VAT_EXCL','VAT_INCL']";
	}elseif($new_price=="VAT_EXCL"){
		$js_price = "['VAT_EXCL']";
	}elseif($new_price=="['VAT_INCL']"){
		$js_price = "VAT_INCL";
	}	
	

	/* if automatic language getting locale */
	/* else getting added language from database */
	
	$automatic = get_option('pilvi_emb_language');
	
		if($automatic == "auto"){	
			$js_lang = get_locale();
		}else{
			$js_lang = get_option('pilvi_emb_language');
		}	
	
	/* saving variables to database what pastes them to js file in hook */
	/* will be used in class-pilvi-embed-public.php */
	
	
	$js_host = get_option('pilvi_emb_session_host');
	$js_api_host = get_option('pilvi_emb_api_host');
	$js_https = get_option('pilvi_emb_https');
	$js_compare = get_option ('pilvi_emb_compare');	
	
	$js_opt_version = 'js_pilvi_emb_version';
	$js_opt_session_host = 'js_pilvi_emb_session_host';
	$js_opt_api_host = 'js_pilvi_emb_api_host';
	$js_opt_language = 'js_pilvi_emb_language';
	$js_opt_prices = 'js_pilvi_emb_prices';
	$js_opt_compare = 'js_pilvi_emb_compare';
	$js_opt_https = 'js_pilvi_emb_https';	
	
	update_option( $js_opt_version, $js_version );
	update_option( $js_opt_session_host, $js_host );
	update_option( $js_opt_api_host, $js_api_host );
	update_option( $js_opt_language, $js_lang );
	update_option( $js_opt_prices, $js_price  ); 
	update_option( $js_opt_compare, $js_compare );
	update_option( $js_opt_https, $js_https );
	
	
?>
