<?php 
if ( ! defined( 'ABSPATH' ) ) exit;
require_once ("admin-page-layout-logic.php"); 
require_once ("admin-variables-for-public-use.php");
?>
<div class="pilvi-embed-admin-body">
<div class="pilvi-embed-admin-options">
	<div class="pilvi-embed-admin-header">
		<img class="pilvi-embed-admin-logo" src="<?php echo esc_url( plugins_url( 'pilvi-embed/images/pilvi-logo-big.png')); ?>" ><br>
	</div>
	<div class="pilvi-embed-admin-secondary-header2">
		<div class="pilvi-embed-admin-add-margin">
			<?php	 
				if($version == "latest"){
					reset($version_parameters);
					$version = key($version_parameters);
				}	
			
				if($last_key==$version){
					print "Latest version ";
				}else{
					print "Version ";	
				}	
				print $version; 
			?> 
			<!-- onclick showing hide button div -->
			is chosen.
			<a class="myLink"  onclick="button_show();">Click here</a> to change it.
			<p class="pilvi-embed-admin-body-text"><?php print $remind; ?></p>
			<form method="post" >
				<div id="hide_button_div">	
					<br><p class="pilvi-embed-admin-body-text">Select version before continuing.<br></p>
					<div class="pilvi-embed-admin-main-buttons-div">
						<INPUT type="Submit" class="pilvi-embed-admin-header-button" onclick="show_changes_information();" Name = "select" VALUE ="Change">
						<select class="pilvi-embed-admin-upper-drop-down"    name="version">
							<option selected='selected'   value='latest'>Latest <?php print $last_key ?></option>
							<?php
								/* feching versions from array to dropdown menu */
								foreach($version_parameters as $key => $value){
									if($last_key == $key){
										print "";
									}elseif($key==$version){ ?>
										<option selected='selected'><?php print $key; ?></option>
									<?php }else{ ?>		
										<option value="<?php print $key; ?>"><?php print $key; ?></option>
									<?php }
								} 
							?>
						</select>
					</div>	
				</div>
			</form>
		</div>		
	</div>
	<hr class="pilvi-embed-admin-separator">
	<p class='pilvi-embed-admin-secondary-header'>Settings (Default)</p>
<form id="main-form" method="post">
	<?php if(isset($version_parameters[$version]['session_host'])){ ?>
		<div class="pilvi-embed-admin-add-margin">
			<p class="pilvi-embed-admin-body-text">Session host</p>
			<p class="pilvi-embed-admin-description-text">Domain/hostname from which the data is fetched<p>
		</div>	
			<div class="pilvi-embed-admin-form-input-position">
				<input type="text" class="pilvi-embed-admin-textarea" name="url" onchange="validate_users_session_host_imput(this.value);" value="<?php print get_option('pilvi_emb_session_host'); ?>" ><br><br>
			</div>
			<div id="hide-alert-session-host">
				<div id="alert-session-host">
				</div>
			</div>
		<hr class="pilvi-embed-admin-separator">
	<?php } ?>
	<?php if(isset($version_parameters[$version]['api_host'])){ ?>
		<div class="pilvi-embed-admin-add-margin">
			<p class="pilvi-embed-admin-body-text">Api host</p>
			<p class="pilvi-embed-admin-description-text">Domain/hostname of the API<br> to which the calls are performed</p>
		</div>	
			<div class="pilvi-embed-admin-form-input-position">
				<input type="text" class="pilvi-embed-admin-textarea" name="site" onchange="validate_users_api_host_input(this.value);" value="<?php print get_option('pilvi_emb_api_host') ?>" ><br><br>
			</div>	
			<div id="hide-alert-api-host">
				<div id="alert-api-host">
				</div>
			</div>
		<hr class="pilvi-embed-admin-separator">
	<?php } ?> 
	<?php if(isset($version_parameters[$version]['opt_prices'])){ ?>
		<div class="pilvi-embed-admin-add-margin">
			<p class="pilvi-embed-admin-body-text">Prices</p> 
			<p class="pilvi-embed-admin-description-text">Price types to show and their order.<br> Defaults to [‘VAT_INCL’,’VAT_EXCL’]</p>
		</div>	
			<div class="pilvi-embed-admin-form-input-position">
				<input type="radio" name="prices" <?php print $VAT_INCL_VAT_EXCL; ?> value="VAT_INCL_VAT_EXCL">VAT_INCL,VAT_EXCL
				<input type="radio" name="prices" <?php print $VAT_INCL; ?> value="VAT_INCL">VAT_INCL<br><br>
				<input type="radio" name="prices" <?php print $VAT_EXCL_VAT_INCL; ?>  value="VAT_EXCL_VAT_INCL">VAT_EXCL,VAT_INCL
				<input type="radio" name="prices" <?php print $VAT_EXCL; ?> value="VAT_EXCL">VAT_EXCL
			</div>
		<hr class="pilvi-embed-admin-separator">
	<?php } ?>
	<?php if(isset($version_parameters[$version]['opt_compare'])){ ?>
		<div class="pilvi-embed-admin-add-margin">
			<p class="pilvi-embed-admin-body-text">Compare product cards</p>
			<p class="pilvi-embed-admin-description-text">Whether to use compare view by default for groups.<br> Defaults to false.</p>
		</div>	
			<div class="pilvi-embed-admin-form-input-position">
				<input type="radio" name="compare" <?php print $true_compare ?> value="true">Yes 
				<input type="radio" name="compare" <?php print $false_compare ?> value="false">No<br><br>
			</div>	
		<hr class="pilvi-embed-admin-separator">
	<?php } ?>
	<?php if(isset($version_parameters[$version]['https'])){ ?>
		<div class="pilvi-embed-admin-add-margin">
			<p class="pilvi-embed-admin-body-text">HTTPS</p>
			<p class="pilvi-embed-admin-description-text">Force HTTPS usage. Defaults to false.</p>
		</div>	
			<div class="pilvi-embed-admin-form-input-position">
				<input type="radio" name="https" <?php print $true_https ?> value="true">Yes 
				<input type="radio" name="https" <?php print $false_https ?> value="false">No<br><br>
			</div>	
		<hr class="pilvi-embed-admin-separator">
	<?php } ?>
	<?php if(isset($version_parameters[$version]['opt_language'])){ ?>
		<div class="pilvi-embed-admin-add-margin">
			<p class="pilvi-embed-admin-body-text">Language</p>
			<p class="pilvi-embed-admin-description-text">Language code of the language in<br> which elements are to be showed on.</p>
		</div>	
			<div class="pilvi-embed-admin-form-input-position">
				<select class="pilvi-embed-admin-drop-down" name="language" value="<?php print get_option('pilvi_emb_language') ?>">
					<option value="auto">Automatic</option>
					<option value="\'en_US\'">en_US</option>
					<option value="\'fi_FI\'">fi_FI</option>
				</select><br><br><br>
			</div>
		<hr class="pilvi-embed-admin-separator">
	<?php } ?>
<br>
	<p class='pilvi-embed-admin-secondary-header'>Available shortcodes</p>	
	<div class="pilvi-embed-admin-add-margin">
	<p class="pilvi-embed-admin-description-text">Shortcode examples whith attributes inside.<br>Id attribute is allways required.<br><br></p>
	
<!--  card_names function activated -->
		<p class="pilvi-embed-admin-body-text">
			<a class="myLink" id="myLink"  onclick="show_product_card_shortcodes();">Shortcodes for product card</a>
		</p>
	</div>	
		<div id="hide-available-product-card-shortcodes">
			<div class="pilvi-embed-admin-add-margin">
				<p class="pilvi-embed-admin-description-text">Shortcode for single product card.</p>
			</div>
			<div class='pilvi-embed-admin-shortcode-div'>
				[pilvi_embed_product_card id="add-id"]  
			</div>
			<hr class="pilvi-embed-admin-separator">
			<div class="pilvi-embed-admin-add-margin">
				<p class="pilvi-embed-admin-description-text">Shortcode for single product card <br> with prices attribute.</p>
			</div>
			<div class='pilvi-embed-admin-shortcode-div'>
				[pilvi_embed_product_card id="add-id" prices="add-prices"]  
			</div>
		</div>
	<div id="hide-available-product-card-shortcodes-separator">
		<hr class="pilvi-embed-admin-separator">
	</div>
	<div class="pilvi-embed-admin-add-margin">
		<p class="pilvi-embed-admin-body-text">
			<a class="myLink" id="my-group-link"  onclick="show_product_card_group_shortcodes()">Shortcodes for product card group</a>
		</p>	
	</div>	
	<div id="hide-available-product-card-group-shortcodes">
		<hr class="pilvi-embed-admin-separator">
		<div class="pilvi-embed-admin-add-margin">
			<p class="pilvi-embed-admin-description-text">Shortcode for product card group.</p>
		</div>
		<div class='pilvi-embed-admin-shortcode-div'>
			[pilvi_embed_product_card_group id="add-id"] 
		</div>
		<hr class="pilvi-embed-admin-separator">
		<div class="pilvi-embed-admin-add-margin">
			<p class="pilvi-embed-admin-description-text">Shortcode for product card group<br> with compare attribute.</p>
		</div>
		<div class='pilvi-embed-admin-shortcode-div'>
			[pilvi_embed_product_card_group id="add-id" compare="true-or-false"] 
		</div>
		<hr class="pilvi-embed-admin-separator">
		<div class="pilvi-embed-admin-add-margin">
			<p class="pilvi-embed-admin-description-text">Shortcode for product card group <br> with prices attribute.</p>
		</div>
		<div class='pilvi-embed-admin-shortcode-div'>
			[pilvi_embed_product_card_group id="add-id" prices="add-prices"] 
		</div>
		<hr class="pilvi-embed-admin-separator">
		<div class="pilvi-embed-admin-add-margin">
			<p class="pilvi-embed-admin-description-text">Shortcode for product card group <br> with all attributes.</p>
		</div>
		<div class='pilvi-embed-admin-shortcode-div'>
			[pilvi_embed_product_card_group id="add-id" prices="add-prices" compare="true-or-false"] 
		</div>
	</div>
</div>
<div class="pilvi-embed-admin-footer">
		<hr class="pilvi-embed-admin-separator-footer">
		<div class="pilvi-embed-admin-main-buttons-div">
			<div id="information-div">
			<p class="pilvi-embed-admin-description-text">Changes saved</p>
			</div>
			<INPUT type="submit" class="pilvi-embed-admin-button-reset" onclick="show_changes_information();" Name = "default" VALUE ="RESET TO DEFAULT SETTINGS">	
			<INPUT type="submit" class= "pilvi-embed-admin-button" onclick="show_changes_information();" Name = "change" VALUE = "Save">
			</form>
		</div>
	</div>
</div>

