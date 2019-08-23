<?php

require_once('connect.php');//this is a parameter into a function to connect the certain database
//use the connection function to connect center
connector('localhost','root','1234567','test');

  $query=mysqli_query($GLOBALS['link'],"SELECT * FROM student WHERE major='0' OR age='0'");//return boolean
  if(!$query){
        echo "failed to get required data!";
        exit();
         }

    $set=array();

    //compare the required amount of data with the available data
    
        while($row = mysqli_fetch_assoc($query) ){
          $set[]=$row;
          //the fetch function returns ARRAY like (array("id", "fN", "lN", "major", "age"),array(),...)
	} 
	//above are client part
echo json_encode($set);
echo "<br/>";
echo "***********"."<br/>";
$new = json_decode(json_encode($set));
var_dump($new);
	 $num=count($set);//need a length of the encode_json from client	
	$decode_result=json_decode(json_encode($set),true); // turning an object into array
	$smallnumber=count($decode_result);
     
	for($i = 0; $i < $num; $i++){
			
			$smallarray=$decode_result[$i];
			$newid=$smallarray[key($smallarray)];
	    	next($smallarray);
	    	$newfn=$smallarray[key($smallarray)];
	    	next($smallarray);
	    	$newln=$smallarray[key($smallarray)];
	    	next($smallarray);
	    	$newage=$smallarray[key($smallarray)];
	    	next($smallarray);
	    	$newmajor=$smallarray[key($smallarray)];
	    	echo $newid . $newfn . $newln. $newage ."<br/>";

      $query="INSERT IGNORE INTO studentm.studentcopy(id, firstName, lastName, age, major) VALUES ( '$newid', '$newfn', '$newln', '$newage', '$newmajor' )";
		$result=mysqli_query($link, $query);
		if(!$result){ 
			$j=$i+1;
			echo "Unable to insert the No.". $j ." data!"." <br/>";
		exit();}else{
           echo "Successfully insert into the table!";
	     }
	}

function comment(){
	$newarray=json_encode($set);
	$num=count($set);//the length of the array(amount of data)
	echo $num . "<br/>";
    $newdata=json_decode(json_encode($set), true);
    $arry=$newdata[0];//return the first array of the newdata_array
    var_dump($arry);
      echo "<br/>";
    var_dump(key($arry));//the pointer is pointing at the first element of the first array and the key()return the first element's key
    next($arry);//pointer moves to the next element of bg_array
     var_dump(key($arry));//return the key of the second element 
   echo "<br/>";
}
   /* $i=0
    for($i;$i<num;$i++){
      while($key= key($set[i])){
    	echo $key ."<br/>";
    	next($set);
    }}
*/

?>