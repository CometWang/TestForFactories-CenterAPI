<?php
ini_set("max_execution_time", 300);
error_reporting(E_ERROR); 

ini_set("display_errors","Off");

function connector($servername,$username,$password,$db){

//need to use this variable in another php file;
GLOBAL $link;
$mysqli = new mysqli($servername, $username, $password, $db);
$link = mysqli_connect($servername, $username, $password, $db);
//GLOBAL $link;

/* check connection */
if (!$link) {
     return "0";

   
	//! error:1
	//http_status_code(202);
    //exit( "Connect failed") ;
  
}


}

date_default_timezone_set("Asia/Shanghai");
?>