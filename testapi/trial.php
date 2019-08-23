<?php

//This script is a module for generating the token
//the process to decrypt the token is included in the api page

function generate_token($key,$time){

   //design a function to encrypt the token based on the key and time
   $t=time();
   $encrypt=($t+15)%500; // or use an encrypt function to get more complex
   echo $encrypt . "<br/>";
   $token=base64_encode($encrypt);
   echo $token;
   return;
}

function decode_token($raw_token,$private_key){

$decode=base64_decode($raw_token);
$result=$decode*$private_key;
$final=$result-15;
$standard=$GLOBALS['t'];
if ($final<=){
  return TRUE;
}else{
  return FALSE;
}
}

date_default_timezone_set('PRC');
$t=date('i');
if(isset($_GET["key"])){
	echo "";
	exit(generate_token($_GET["key"],$t));
}

?>