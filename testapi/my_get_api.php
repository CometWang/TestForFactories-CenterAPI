
<?php
ini_set("max_execution_time", 300);
/*This script connected to the centerdb then get data from centerdb then display the required data*/
require_once('private.php');

require_once('connect.php');//this is a parameter into a function to connect the certain database
//use the connection function to connect center
connector('192.168.50.236','interntest','interntest','rrseccloudtest');


date_default_timezone_set('PRC');


//check the token 
/*
  @parameter: raw_token:from user input; $private_key: to decode the input
  @return: true when it is equal to the set standard value, false otherwie
*/
  
function verify_token($data){
  $data=rawurldecode($data);
 
  //upload the path as the parameter
  $private_key=openssl_pkey_get_private($GLOBALS['RSA_PRIVATE']);
  if(!$private_key){
    //! error:2
    header('Content-Type: application/json');
   exit(handle_error('2',''));
    //return('Unable to use the private_key');
  }
 
  
  $ret=openssl_private_decrypt(base64_decode($data), $decrypted, $private_key);
  
  if(!$ret){
    //! error:3
     exit(handle_error('3',' '));

  }
  
  $final=preg_split("/,/", $decrypted);

  if($final[1]<=(time()+1)){
  
    return TRUE;
  }
  else{
    //echo"Access denied";
    return FALSE;
  } 
}

/*check the amount of available datas
  @return: amount
*/
function check_available(){
   $query=mysqli_query($GLOBALS['link'],"SELECT miiodid,miiokey,miiomac FROM rrsecmiio WHERE IN_USE=0  ");//return boolean
   if(!$query){
    //! error:6
     //   echo "failed to get required data!";
        //exit();
    exit(handle_error('6',''));
         }

    $available=mysqli_num_rows($query);
    return $available;
}
/*
@parameter: num (the amount of needed information)
@return: all columns where IN_USE=0; COMPLETE=0*/
function get_method($num){

   $lock=mysqli_query($GLOBALS['link'],"LOCK TABLES rrsecmiio WRITE;");
   if (!$lock){
  //! error:7
     //echo "failed to lock the table!"."<br/>";
     exit(handle_error('7',''));
   }
$available=check_available();
$set=array();
$query=mysqli_query($GLOBALS['link'],"SELECT miiodid,miiokey,miiomac FROM rrsecmiio WHERE IN_USE='0' ORDER BY uid LIMIT $num;");//return boolean
$query2=mysqli_query($GLOBALS['link'],"UPDATE rrsecmiio SET IN_USE='1' where IN_USE='0' ORDER BY uid LIMIT $num;");

if(!$query){
  //! error:8
        //echo "failed to get required data!";
   exit(handle_error('8',''));
         }
  //*unlock the table   
if($query2){
   $unlock=mysqli_query($GLOBALS['link'], "UNLOCK TABLES;");    
   if(!$unlock){
    //! error:10
        exit(handle_error('10',''));
       }
     } else{
  //! error:9
  exit(handle_error('9',''));

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

   //$encode=json_encode($set);

   return handle_error('0',$set);

  
  //$encode=json_encode($set);
  header('Content-Type: application/json');
  

  return $e;
}



//a function to verify the correct amount of data 
/*
@param:client_value,json_form_data
@return: a msg to confirm a success or failure
*/

//analyze the token first before executing any action

if(isset($_GET["token"])){


  $verify=verify_token($_GET["token"]);
  if (!$verify){
    //! error:4
    exit(handle_error('4',''));
  }
}else{
  //! error:5
  exit(handle_error('5',''));
}

//the method to check available amount of data
if(isset($_GET["amount_check"])){
  $available=check_available();
  $text="There are ". $available . " data can be accessed." ;
  exit(handle_error('14',$text));
}

//consider the condition from the client's input situation
//like main function
if (isset($_GET["action"])=="get_center_info"){
  
   if(isset($_GET["num"])== TRUE){
    	if($_GET["num"] > 10000){
      //! error:11
    	   exit(handle_error('11','')); }
        elseif ($_GET["num"]  < 0) {
      //! error:12
       exit(handle_error('12',''));
       }
        else{      
          
//return the required data in json form
       $enjsondata=get_method($_GET["num"]);
       header('Content-Type: application/json');
        
      echo $enjsondata;

      }
     }
     else{ 
      //! error:13
      exit(handle_error('13',''));;}
}

mysqli_close($link);
?>