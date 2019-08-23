<?php

$servername = 'localhost';
$username = 'root';
$password='1234567';
$db='test';

$mysqli = new mysqli($servername, $username, $password, $db);
$link = mysqli_connect($servername, $username, $password, $db);

/* check connection */
if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}
else{echo "successfully connected" . "<br/>";}

//test to print out the data in .sql
$query = mysqli_query($link,"SELECT id, firstName FROM student");

if($query == TRUE){
    printf("<br/>"."query received."."<br/>");}
else{
	echo "unkown query" . "<br/>";
    exit();
}

if(mysqli_num_rows($query) > 0){
	    while($row = mysqli_fetch_assoc($query)){
		 echo " id: " . $row["id"]. " firstName: " . $row["firstName"] . "<br/>";
		}
}
else{
		echo "failed to print datas ";
}

//build a get function to get the certain required information
function get_student_info($id){
	echo"ininin" . "<br/>";
   $query = mysqli_query($GLOBALS["link"],"SELECT * FROM student WHERE id='$id'");
   
   if(!$query){
   	echo "id not exist!";
    exit();
  }
  if(mysqli_num_rows($query) > 0){
	   while($row = mysqli_fetch_assoc($query)){
	    	 echo " id: " . $row["id"]. "   firstName: " . $row["firstName"] . "   age: " . $row["age"] . "   major: " . $row["major"] . "<br\>"  ;
		} 
		
}else{echo "failed to print data";}

return;
}

if(isset($_GET["action"]) == "get_student_info"){
    
    // Get the specific student data
    $student_info= get_student_info($_GET["id"]);
    
   
}

mysqli_close($link);

?>
