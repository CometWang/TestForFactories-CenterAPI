<?php

require_once('private.php');
date_default_timezone_set('PRC');
$t=time()+10;

function verify_token($data){
	$private_key=openssl_pkey_get_private($GLOBALS['RSA_PRIVATE']);
	if(!$private_key){
		//return('Unable to use the private_key');
        echo 'Unable to use the private_key';
	}
	$ret=openssl_private_decrypt(base64_decode($data), $decrypted, $private_key);
	if(!$ret){
		//return('failed to decode');
        echo 'failed to decode';

	}
	
	
    echo 'a';
	echo $decrypted;


}

echo '1';
$raw='Lk8ANX0dhtzVdFvMGFWXzvTNwKUCTo9CLHWHiROfVCOtuLuurAwWMe1pEGzLHP+8dKuAniezg1ipDR+lS/5YT4TwYtykY4IOXa1a15ICQ9pwBOfBjRnqXF8XN2tUWfERTHA8Cb+K+6eBnVCi6epYwwPykJJBsWZ5kq7YL2HZVbw=';
echo '2';
verify_token($raw);
echo '3';

?>
    
   