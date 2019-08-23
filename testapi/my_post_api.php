<?php
ini_set("max_execution_time", 500);
//This script downloaded the data from a database 'test'(folder: test) to another local database 'studentM'(in folder:testapi)
require_once('connect.php');//this is a parameter into a function to connect the certain database
//use the connection function to connect center
connector('192.168.50.236','interntest','interntest','rrseccloudtest');
require_once('private.php');
date_default_timezone_set('PRC');

#echo $RSA_PRIVATE.'<br\>';
//this function takes the token from client code then decode to verify 
function check_token($token){
  
  $private_key=openssl_pkey_get_private($GLOBALS['RSA_PRIVATE']);

  if(!$private_key){
    exit(handle_error('2',''));
    #return('Unable to use the private_key');
  }
  #echo base64_decode($token);

  $ret=openssl_private_decrypt(base64_decode($token), $decrypted, $private_key);
  
  
  if(!$ret){
   exit(handle_error('3',' '));
   #exit("wrong!");

  }

  $final=preg_split("/,/", $decrypted);

  if($final[1]<=(time()+1)){
  
  return TRUE;
}
  else{
  
  return FALSE;
  } 
}


/*this function takes an encode_array as parameter and transform into the right form to insert into centerdb
@param: $enjson (en_json data STRING from client code), 
    $amount_of_trans(the amount of data which has been selected and encoded into json in the client_code)
@return:amount of data that have been inserted
*/
function post_method($enjson,$amount_of_trans,$table){

  //lock the center db table that will be inserted into 
 
 //need a length of the encode_json from client  
  $decode_result=json_decode($enjson,true); // turning an object into array
 
  $amount_of_insert=0;

/*traversal the whole de_json data as an array(can be accessed by index) 
  and every row of data can only by accessed by pointer NOT by index
  use every row of data as a unit to insert into the local centerdb
 */

  //if the factory data is from rrsectb then insert them into rrsecbk in center:
  
if($table=='table1'){
 
 $lock=mysqli_query($GLOBALS['link'],"LOCK TABLES rrsecbk WRITE;");
   if (!$lock){
     //echo "The table has been locked!"."<br/>";
     exit(handle_error('7',''));
   }
  
   for($i = 0; $i < $amount_of_trans; $i++){
      
      $smallarray=$decode_result[$i];
 
        next($smallarray);
        $miiodid=$smallarray[key($smallarray)];
     
        next($smallarray);
        $miiokey=$smallarray[key($smallarray)];
        next($smallarray);
        $miiomac=$smallarray[key($smallarray)];
        next($smallarray);
        $miiosn=$smallarray[key($smallarray)]; 
        next($smallarray);
        $cpusn=$smallarray[key($smallarray)];
        next($smallarray);
        $mcuid=$smallarray[key($smallarray)];
        next($smallarray);
        $emcuid=$smallarray[key($smallarray)];
        next($smallarray);
        $ecpuid=$smallarray[key($smallarray)];
        next($smallarray);
        $dkey=$smallarray[key($smallarray)];
        next($smallarray);
         $checksum=$smallarray[key($smallarray)];
        next($smallarray);
        $clientinfo=$smallarray[key($smallarray)];
        next($smallarray);
        $date=$smallarray[key($smallarray)];
        next($smallarray);
        $appassword=$smallarray[key($smallarray)]; 
        next($smallarray);
        $prodtype=$smallarray[key($smallarray)];
        next($smallarray);
        $devtype=$smallarray[key($smallarray)];
        next($smallarray);
        $IN_USE=$smallarray[key($smallarray)];
        next($smallarray);
        $COMPLETE=$smallarray[key($smallarray)];
      

      $query="INSERT IGNORE INTO rrsecbk(miiodid,miiokey,miiomac,miiosn,cpusn,mcuid,emcuid,ecpuid,dkey,checksum,clientinfo,date,appassword,prodtype,devtype,IN_USE,COMPLETE) VALUES ( '$miiodid','$miiokey','$miiomac','$miiosn','$cpusn','$mcuid','$emcuid','$ecpuid','$dkey','$checksum','$clientinfo','$date','$appassword','$prodtype','$devtype','$IN_USE','$COMPLETE' );";
      $result=mysqli_query($GLOBALS['link'], $query);

     /* if(!$result){ 
         $flag=1;
         $j=$i+1;
         $text="Unable to insert the No.". $j ." data!";
         $message[]=$text;
      }*/
         $amount_of_insert++;
  
}
  $unlock=mysqli_query($GLOBALS['link'],"UNLOCK TABLES;");
   if (!$unlock){
     //echo "The table has been locked!"."<br/>";
     exit(handle_error('10',''));
   
 }
}


else{ 

$lock=mysqli_query($GLOBALS['link'],"LOCK TABLES rrsecdevinfobk WRITE;");
   if (!$lock){
     //echo "The table has been locked!"."<br/>";

    exit(handle_error('7',''));
   }
  //if the data is from rrsecdevinfo in factory then insert them into rrsecdevinfobk in center

  for($i = 0; $i < $amount_of_trans; $i++){
      $smallarray=$decode_result[$i];
        next($smallarray);
        $miiosn=$smallarray[key($smallarray)];
        next($smallarray);
        $lastaccessdate=$smallarray[key($smallarray)];
        next($smallarray);
        $isbackup=$smallarray[key($smallarray)];
        next($smallarray);
        $macaddr=$smallarray[key($smallarray)];
        next($smallarray);
        $bootloaderver=$smallarray[key($smallarray)];
        next($smallarray);
        $kernelver=$smallarray[key($smallarray)];
        next($smallarray);
        $kernelbuildtime=$smallarray[key($smallarray)];
        next($smallarray);
        $emmc=$smallarray[key($smallarray)];
        next($smallarray);
         $ddr=$smallarray[key($smallarray)];
        next($smallarray);
        $compassid=$smallarray[key($smallarray)];
        next($smallarray);
        $apver=$smallarray[key($smallarray)];
        next($smallarray);
        $ldsver=$smallarray[key($smallarray)];
        next($smallarray);
        $ldsid=$smallarray[key($smallarray)];
        next($smallarray);
        $mcuver=$smallarray[key($smallarray)];
        next($smallarray);
        $testinfo=$smallarray[key($smallarray)];
        next($smallarray);
        $pn=$smallarray[key($smallarray)];
        next($smallarray);
        $rtc=$smallarray[key($smallarray)];
        next($smallarray);
        $mcuid=$smallarray[key($smallarray)];
        next($smallarray);
        $batid=$smallarray[key($smallarray)];
        next($smallarray);
        $gyroid=$smallarray[key($smallarray)];
        next($smallarray);
        $chargerid=$smallarray[key($smallarray)];
        next($smallarray);
        $acccal=$smallarray[key($smallarray)];
        next($smallarray);
        $gyrocal=$smallarray[key($smallarray)];
        next($smallarray);
        $wallsensorcal=$smallarray[key($smallarray)];
        next($smallarray);
        $cliffcal1=$smallarray[key($smallarray)];
        next($smallarray);
        $cliffcal2=$smallarray[key($smallarray)];
        next($smallarray);
        $cliffcal3=$smallarray[key($smallarray)];
        next($smallarray);
        $cliffcal4=$smallarray[key($smallarray)];
        next($smallarray);
        $cliffcal5=$smallarray[key($smallarray)];
        next($smallarray);
         $cliffcal6=$smallarray[key($smallarray)];
        next($smallarray);
        $WallsensorID=$smallarray[key($smallarray)];
        next($smallarray);
        $Compass2ID=$smallarray[key($smallarray)];
        next($smallarray);
        $Camera0ID=$smallarray[key($smallarray)];
        next($smallarray);
        $Camera1ID=$smallarray[key($smallarray)];
        next($smallarray);
          $infofilelength=$smallarray[key($smallarray)];

       
        //echo $newid . $newfn . $newln. $newage ."<br/>";

      $query="INSERT IGNORE INTO rrsecdevinfobk(miiosn, lastaccessdate, isbackup, macaddr,bootloaderver,kernelver,kernelbuildtime,emmc,ddr,compassid,apver,ldsver,ldsid,mcuver,testinfo,pn,rtc,mcuid,batid,gyroid,chargerid,acccal,gyrocal,wallsensorcal,cliffcal1,cliffcal2,cliffcal3,cliffcal4,cliffcal5,cliffcal6,WallsensorID,Compass2ID,Camera0ID,Camera1ID,infofilelength) VALUES ('$miiosn', '$lastaccessdate', '$isbackup', '$macaddr','$bootloaderver','$kernelver','$kernelbuildtime','$emmc','$ddr','$compassid','$apver','$ldsver','$ldsid','$mcuver','$testinfo','$pn','$rtc','$mcuid','$batid','$gyroid','$chargerid','$acccal','$gyrocal','$wallsensorcal','$cliffcal1','$cliffcal2','$cliffcal3','$cliffcal4','$cliffcal5','$cliffcal6','$WallsensorID','$Compass2ID','$Camera0ID','$Camera1ID','$infofilelength')";
      $result=mysqli_query($GLOBALS['link'], $query);
    
        $amount_of_insert++;
   }
  
}

  //release the locked table
  $unlock=mysqli_query($GLOBALS['link'], "UNLOCK TABLES;");    
        if(!$unlock){
           //echo "The table has been released!"."<br/>";
      exit(handle_error('10',''));
       }
 
  return $amount_of_insert;
}




/*this function takes the result of the post_method, amount that has been inserted(BEFORE encode_json!), as parameter to verify the complete of insertation
@param: amount_of_insert
@return: boolean
*/
function verify($amount_of_insert,$amount_of_trans){
if($amount_of_trans==$amount_of_insert){
  return TRuE;
}else{
  return FALSE;
}

}

$json_string = file_get_contents('php://input');
$response_data = json_decode($json_string, true);

/*the main function will check the post of parameter:enjson(which is an array), also the amount of data which have been transmitted to the api
@all the parameters are from client_code
@will exit once when the information is wrong ?or try again?*/

//verift the token: exit when wrong or not given
if(isset($response_data['token'])){
  if(!check_token($response_data['token'])){
    #exit("Access denied!");
    exit(handle_error('4',''));
  }
}else{
  exit(handle_error('5',''));
  #exit("Access denied!");
}

//insert the data into centerdb and verify the amount by comparing amount of transmitting with the amount of inserting

/*echo $response_data['amount_of_trans'] ;*/


if(isset($response_data['enjson']) and isset($response_data['amount_of_trans'])){
    $insertAmount=post_method($response_data['enjson'],$response_data['amount_of_trans'],$response_data['table']);
    if ($insertAmount>0 ){
      $result=verify($insertAmount,$response_data['amount_of_trans']);
      if($result){
        exit(handle_error('0',' '));
        #exit();
      }else{
        $result1="Incorrect number ". $response_data['amount_of_trans']. " of inserting! Suppose to insert" . $response_data['amount_of_trans'] . "numbers of data. Only " . $insertAmount . " of data have been inserted!";
        exit(handle_error('14',$result1));
        #echo "Incorrect number ". $response_data['amount_of_trans']. " of inserting!" . "<br/>";
        #echo "Suppose to insert" . $response_data['amount_of_trans'] . "numbers of data. Only " . $insertAmount . " of data have been inserted!" . "<br/>";
            exit();
              }
    }else{
      $text="Amounr of trans is:".$response_data['amount_of_trans']."Amount of insert is ".$insertAmount;
      //echo "Incorrect amount of inserting ";
      exit(handle_error('14',$text));
    }
}
else{
  $text="Not Enough INput!";
  exit(handle_error('14',$text));
 
}


?>
