/*pilvi embed admin js */
/*hiding and showing change button*/
	
	var count = 0;
	var count_group = 0;
	
	var pluginsUrl = plugins_path.pluginsUrl;
	
	function button_hide(){
		document.getElementById("hide_button_div").style.display = "none";
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
		document.getElementById("hide-available-product-card-shortcodes").style.display = "none";
		document.getElementById("hide-available-product-card-shortcodes-separator").style.display = "none";
		
		if(count != 0){
			count = -1;
		}	
	}	
	
	function hiding_available_group_shortcodes(){
		document.getElementById("hide-available-product-card-group-shortcodes").style.display = "none";
		
		if(count_group != 0){
			count_group = -1;
		}
	}	
		
	function show_product_card_shortcodes(){
		if(count == 0){
			document.getElementById("hide-available-product-card-shortcodes").style.display = "inline";
			document.getElementById("hide-available-product-card-shortcodes-separator").style.display = "inline";
		}else{
			hiding_available_shortcodes();
		}
		count++;
	}	
	
	function show_product_card_group_shortcodes(){
		if(count_group == 0){
			document.getElementById("hide-available-product-card-group-shortcodes").style.display = "inline";
		}else{
			hiding_available_group_shortcodes();
		}
		count_group++;
	}	
	/* hiding alert div */
	function hiding_session_host_alert(){
		document.getElementById("hide-alert-session-host").style.display = "none";
	}
	/* hiding alert2 div */
	function hiding_api_host_alert(){
		document.getElementById("hide-alert-api-host").style.display = "none";
	}
	
	function hide_changes_information(){
		document.getElementById("information-div").style.display = "none";
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
	
	
	/*js for pilvi embed tiny mce button*/
	
	(function() {
    tinymce.PluginManager.add('pilvi_button_plugin', function( editor, url ) {
        editor.addButton( 'pilvi_button_plugin', {
            /*name*/
			title: 'Pilvi embed button',
            /*image url */
			image: pluginsUrl + "/pilvi-embed/images/icon-tiny-mce.png",
            /* button type */
			type: 'menubutton',
			/* button functionality<-- 2 options --> */
			menu:  [
                {
					/* button to product card */
                    text: 'Product card',
                    /* shortcode value */
					value: '[pilvi_embed_product_card id="add-id"]',
                    /* if button is clicked */
					onclick: function() {
                        editor.insertContent(this.value());
                    }
                },
				{
					/* button for product card group */
                    text: 'Product card group',
					/* value */
                    value: '[pilvi_embed_product_card_group id="add-id"]',
                    /* if clicked */
					onclick: function() {
                        editor.insertContent(this.value());
                    }
                },
		   
		   ]
        });
    });
})();

	
	