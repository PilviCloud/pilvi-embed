/*js for pilvi embed tiny mce button*/
	
	(function() {
    tinymce.PluginManager.add('pilvi_button_plugin', function( editor, url ) {
        editor.addButton( 'pilvi_button_plugin', {
            /*name*/
			title: 'Pilvi embed button',
            /*image url */
			image: "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsQAAA7EAZUrDhsAAAAZdEVYdFNvZnR3YXJlAEFkb2JlIEltYWdlUmVhZHlxyWU8AAACTUlEQVQ4T31TPU8UURQ9M7uzs+yuLCEaXA0SitUINFZqoSFGEyUW+gNES0OhjZ12llQ2FsZEO1tjQE0s0JAYC42FAT+C6LJRFNcN7NfM7Hw8z33rEmDFM8nMm/vuue+ee+8zFIENWG4EePjFw5Oihw9rvrYdzFo43W/j3KCNXCqubW2sB2iGCrfna7j1roFCPUB/OobBHTHttFgNUayF/I/jykgKE0MZJGKG3tMBgkjh5tsK7sw78LkeG7BxKZ/C6B5bOz3/5uH+QgOPCx7ipoHLQ124cahbr3WA2WUP4y/KaAbAAE99NrYTacvU5DbqQYRTUyUUmEmSid0b7cXxnA16KUwtufBDoBEoTB7OdpAF6biJySNZ7eNFwNOiS6uCKcRPqz6XBvqoO59t6f4XZG93JgalDMyRw6QgKuRFI2AbBmjbFuIThWTQX/eCgUzyW+BXkzc1dTPelHysOCESGzidYrdBxO5cf13FriQp7QCE+b8TI+bc8CNMLzk49qiEVS9EJkGKSBEHfilBgd2jsTPS50qIE2zdhZkyfnkKPXarwEIWd8XHZHcw3GPpim7F12qAamDo8c1Ykncrdxm8A+RYjKcFndmX1IVx2WOZLsFvN8Tdj3X2PeLYtpTKjsN/IZ4lRyy6iEf7Ehjfn0KVemUuZn94uPaqgpc/fXRTsxBNSnV4QJlTdJG+whGsXyZXLtNcDQ8WXLxfa6KLp+Y4WHKCjPGKE6GXwa6OpDExvOUy6dVfLFL3dMHFzPcmi+jrguW7LZzca+N8x3UG/gCykAWTd5SjYQAAAABJRU5ErkJggg==",
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
