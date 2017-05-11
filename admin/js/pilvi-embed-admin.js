/*pilvi embed admin js */
/*hiding and showing change button*/
	
	var count = 0;
	var count_group = 0;
	
	var pluginsUrl = plugins_path.pluginsUrl;
	
	function button_hide(){
		
		if (jQuery('#hide_button_div').length > 0) {
			document.getElementById("hide_button_div").style.display = "none";
		}	
		
		if(count != 0){
			count = -1;
		}	
	}
	
	function button_show() {
		if (count == 0) {
			document.getElementById("hide_button_div").style.display = "inline";
		}else{
			button_hide();
		}
		count++;
	}
	
	function hiding_available_shortcodes(){
		
		if (jQuery('#hide-available-product-card-shortcodes').length > 0) {
			document.getElementById("hide-available-product-card-shortcodes").style.display = "none";
			document.getElementById("hide-available-product-card-shortcodes-separator").style.display = "none";
			document.getElementById("myLink").innerHTML = "Shortcodes for product card <i class='fa fa-angle-down' aria-hidden='true'></i>";
		}
		if(count != 0){
			count = -1;
		}	
	}	
	
	function hiding_available_group_shortcodes(){
		
		if (jQuery('#hide-available-product-card-group-shortcodes').length > 0) {
			document.getElementById("hide-available-product-card-group-shortcodes").style.display = "none";
			document.getElementById("my-group-link").innerHTML = "Shortcodes for product card group <i class='fa fa-angle-down' aria-hidden='true'></i>"
		}
		if(count_group != 0){
			count_group = -1;
		}
	}	
		
	function show_product_card_shortcodes(){
		if(count == 0){
			document.getElementById("hide-available-product-card-shortcodes").style.display = "inline";
			document.getElementById("hide-available-product-card-shortcodes-separator").style.display = "inline";
			document.getElementById("myLink").innerHTML = "Shortcodes for product card <i class='fa fa-angle-up' aria-hidden='true'></i>";
		}else{
			hiding_available_shortcodes();
		}
		count++;
	}	
	
	function show_product_card_group_shortcodes(){
		if(count_group == 0){
			document.getElementById("hide-available-product-card-group-shortcodes").style.display = "inline";
			document.getElementById("my-group-link").innerHTML = "Shortcodes for product card group <i class='fa fa-angle-up' aria-hidden='true'></i>"
		}else{
			hiding_available_group_shortcodes();
		}
		count_group++;
	}	
	/* hiding alert div */
	function hiding_session_host_alert(){
		if (jQuery('#hide-alert-session-host').length > 0) {
			document.getElementById("hide-alert-session-host").style.display = "none";
		}	
	}
	/* hiding alert2 div */
	function hiding_api_host_alert(){
		if (jQuery('#hide-alert-api-host').length > 0) {
			document.getElementById("hide-alert-api-host").style.display = "none";
		}	
	}
	
	function hide_changes_information(){
		if (jQuery('#information-div').length > 0) {
			document.getElementById("information-div").style.display = "none";
		}	
	}
	function show_changes_information(){
		sessionStorage.setItem('show', 'true');
	}
	function local_store(){
		var show = sessionStorage.getItem('show');
		if(show === 'true'){
			document.getElementById("information-div").style.display = "inline";
			setTimeout(function(){ 
				document.getElementById("information-div").style.display = "none";
			}, 2000);
			sessionStorage.removeItem('show');
		}
	}
	/* hiding version change button and alerts --> after page is loaded */
	jQuery(window).bind("load", function() {
		button_hide();
		hiding_available_shortcodes();
		hiding_available_group_shortcodes();
		hiding_session_host_alert();
		hiding_api_host_alert();
		hide_changes_information();
		local_store();
	});
	
	function validate_users_session_host_imput(value){
		
		jQuery(document).ready(function($) {
			
			hiding_session_host_alert();
			var uri = value;
			var res = encodeURI(uri);
			
			var data = {
				'action': 'my_action',
				'query': res
			};
			
			jQuery.post( ajaxurl, data, function(response) {
				var myJSON = JSON.stringify(response);
				json = JSON.parse(myJSON)
					if(json.response == false){
					
						function showAlertSessionHost(){
							document.getElementById("hide-alert-session-host").style.display = "inline";
						}
						showAlertSessionHost();
						document.getElementById("alert-session-host").innerHTML = "Incorrect session host. Please verify the host and try again.";
					}
						
					
			});
		
		});
		
		
	}	
	
	function validate_users_api_host_input(value){
		
		jQuery(document).ready(function($) {
			
			hiding_api_host_alert();
			var uri = value;
			var res = encodeURI(uri);
			
			var data = {
				'action': 'my_action2',
				'call': res
			};
			
			jQuery.post( ajaxurl, data, function(response) {
				var myJSON = JSON.stringify(response);
				json = JSON.parse(myJSON)
					if(json.response == false){
						
						function showAlertApiHost(){
							document.getElementById("hide-alert-api-host").style.display = "inline";
						}
						showAlertApiHost();
						document.getElementById("alert-api-host").innerHTML="Incorrect api host. Please verify the host and try again.";
					}
				
					
			});
			
		
		});
	}	
	
	
	
	