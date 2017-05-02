<?php

/* getting chosen host  */	
	
    if(isset($_GET['call'])){
		header('Content-Type: application/json');
	    $newurl = ($_GET['call']);
		$decoded_url = urldecode ( $newurl );
		
		/* filtering host in right shape */
		$validurl = filter_var($decoded_url, FILTER_SANITIZE_URL);	
		
				function not_valid_host(){
					
					/* "is not a valid host" */
					$answer = new stdClass();
					$answer = false;
					$myJSON = json_encode($answer);
					print $myJSON;
				
				}
				/* checking that ip or url is not puttetd in textarea */
				
					if (filter_var($validurl, FILTER_VALIDATE_IP) === true) {
						not_valid_host();
						exit;
					}
					
					if(filter_var($validurl, FILTER_VALIDATE_URL) === true) {
						not_valid_host();
						exit;
					}
					
				/* if not >> getting hosts ip and checking that ip is correct & site is availble */ 	
						
			if($validurl != "" and filter_var(gethostbyname($validurl), FILTER_VALIDATE_IP)){
				/* "is a valid host" */
				$answer = new stdClass();
				$answer = true;
				$myJSON = json_encode($answer);
				print $myJSON;
			
			} else {
				not_valid_host();
			
			}
	}
/* check dokumentation above */	
	if(isset($_GET['query'])){
		header('Content-Type: application/json');
		$address = ($_GET['query']);
		$decoded_address = urldecode ( $address );
		$validate_address = filter_var($decoded_address, FILTER_SANITIZE_URL);
		
			function not_valid_host(){
				
				$answer2 = new stdClass();
				$answer2 = false;
				$myJSON2 = json_encode($answer2);
				print $myJSON2;	
				
			}
			
			if (filter_var($validate_address, FILTER_VALIDATE_IP) === true) {
				not_valid_host();
				exit;
			} 	
			
			if($validate_address != "" and filter_var(gethostbyname($validate_address), FILTER_VALIDATE_IP)){
				$answer2 = new stdClass();
				$answer2 = true;
				$myJSON2 = json_encode($answer2);
				print $myJSON2;
			}else{
				not_valid_host();
			}	
	}
?>
