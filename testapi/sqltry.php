<?php

require_once('connect.php');//this is a parameter into a function to connect the certain database
//use the connection function to connect center
connector('localhost','root','1234567','test2');
$public_key=500;
date_default_timezone_set('PRC');
$t=time();
$num=3;
$available=9;
$set=array();
$query=mysqli_query($GLOBALS['link'],"SELECT firstName,lastName FROM student2 WHERE age=0 and major='0' ORDER BY id LIMIT $num");//return boolean
$query2=mysqli_query($GLOBALS['link'],"UPDATE student2 SET age=1,major='1' where age=0 and major='0' ORDER BY id LIMIT $num;");

if(!$query){
        echo "failed to get required data!";
        exit();
         }
if($query2){
   $unlock=mysqli_query($GLOBALS['link'], "UNLOCK TABLES;");    
   if(!$unlock){
        echo "unable to release the table";
        exit();
       }
    //compare the required amount of data with the available data
if($num < $available){
        while($num>0 and $row = mysqli_fetch_assoc($query) ){
          $set[]=$row;
          //the fetch function returns ARRAY like (array("id", "fN", "lN", "major", "age"),array(),...)    
	        $num--;}
        
        }

   else{
      //echo "*Only " . $available . " number of required data can be found!*" . "<br/>";
      while($row = mysqli_fetch_assoc($query)){
         $set[]=$row;
         
        }
}
//*unlock the table   

  
  $encode=json_encode($set);
  header('Content-Type: application/json');
  echo $encode;
  return $encode;
}else{
  exit("FAILED TO UPDATE");

}


$decrypted = "";
$priv_key = openssl_pkey_get_private($key_location); //c:\a.pem
$db64 = base64_decode($encrypted_content);
if (!openssl_private_decrypt($db64,$decrypted,$priv_key)){
//fail
}else
{

}
?>
