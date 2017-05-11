/* pilvi embed public js */

foo = {};

if(php_variables.SESSION_HOST != ""){
	foo.SESSION_HOST = php_variables.SESSION_HOST;
}
if(php_variables.API_HOST != ""){
	foo.API_HOST = php_variables.API_HOST;
}
if(php_variables.HTTPS != ""){
	foo.HTTPS = php_variables.HTTPS;
}
if(php_variables.LANGUAGE != ""){
	foo.LANGUAGE = php_variables.LANGUAGE;
}
if(php_variables.PRICES != ""){
	foo.PRICES =  php_variables.PRICES;	
}
if(php_variables.COMPARE == "true"){
	foo.COMPARE = php_variables.COMPARE;
}	

PilviEmbedded.init(foo);
	
	

