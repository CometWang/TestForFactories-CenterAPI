
<?php
/* ▲ First verify whether all the $GET has a valid variable
*/

session_start();


if (!isset($_SESSION['EXPIRES']) || $_SESSION['EXPIRES'] < time()) {
    session_destroy();
    $_SESSION = array();
    $msg= "Please login";
    echo"<script type='text/javascript'>alert('$msg');
    window.location.href='loginpage.html'</script>
    ";
    exit();
}

if(!isset($_SESSION['username'])){
  session_destroy();
  $_SESSION = array();
  $msg= "Please login";
    echo"<script type='text/javascript'>alert('$msg');
    window.location.href='loginpage.html'</script>
    ";
  //header("Location: loginpage.html");
  exit();
}

$output="";
$user = $_GET["serialNum"];
$table = $_GET["table"];

if(empty($user) or empty($table)){
  $output="Invalid Input!";
  $aa=file_get_contents('resultHandle.html');
  $search=array("<p id=\"demo\"></p>");
  $replace=array("<table>$output</table>");
  $naa=str_replace($search,$replace, $aa);
  echo $naa;

  exit();

}

require_once('connection.php');
connector("localhost","root","1234567","test");



/*This function will handle the data in first table and return json data
  @param:$tablename
  @return:$jsondata (in json)
*/
function handle_firstTable($user){
     $query="SELECT miiodid,miiomac,appassword,cpusn FROM rrsecbk where miiosn='$user' ORDER BY uid DESC LIMIT 3";
     $job=mysqli_query($GLOBALS['link'],$query);
     if(!$job){
       return error_handle('0');
     }
     
     while ($row=mysqli_fetch_assoc($job)){
       $set[]=$row;
     }
     if($set==NULL){
      return error_handle('1');
     }
    
     return $set;
  /*
    $new=json_encode($set);
    $aa=file_get_contents('errorHandle.html');
    $search=array("<p id=\"error\">123</p>");
   

    $replace=array("<p>$new</p>");
    $naa=str_replace($search,$replace, $aa);
    echo $naa;
    //header("Location: errorHandle.html");
     
     exit();*/

}


/*This function will handle the data in the second table and return required json data
  @param:$tablename; $inputtext
  @return:$jsondata
*/
function handle_secondTable($user){
     $query="SELECT miiosn FROM rrsecdevinfobk  where pn ='$user' ORDER BY uid DESC LIMIT 1";
     $job=mysqli_query($GLOBALS['link'],$query);
     if(!$job){
       return error_handle('0');
     }
     //header("Location: errorHandle.html");
     while ($row=mysqli_fetch_assoc($job)){
       $set[]=$row;
     }
     if($set==NULL){
      return error_handle('1');
     }
    
    // ECHO json_encode($set);
     $newgoal=$set[0]['miiosn'];
    // echo $newgoal;
     //exit();
     $newquery="SELECT miiodid,miiomac,appassword,cpusn FROM rrsecbk where miiosn='$newgoal' order by uid desc limit 3";
     $newjob=mysqli_query($GLOBALS['link'],$newquery);
     if(!$newjob){
      return error_handle('0');
     }
     while ($row=mysqli_fetch_assoc($newjob)){
      $newset[]=$row;
    }
    if(count($newset)==0){
      return error_handle('1');
    }
     return $newset;

}

/*sort the returned json data into table
@param: $jsondata(the returned json data from the previous function)
*/
function table($jsondata){
  $len=count($jsondata);
  $output="<table>";
  $output .= "<tr>";
  $output .= " <th> miiodid </th> <th> miiomac </th> <th> appassword </th> <th> cpusn </th> ";
  $output .="</tr>";
  for($i=0; $i<$len; $i++){
     $output .= "<tr>";
     $output .=  "<td width=30%>". $jsondata[$i]['miiodid'] ."</td>";
     $output .=  "<td width=30%>". $jsondata[$i]['miiomac']."</td>";
     $output .=  "<td width=30%>". $jsondata[$i]['appassword']."</td>";
     $output .= "<td width=60%>". $jsondata[$i]['cpusn']."</td>";

  }
  $output .= "</table>";
  $aa=file_get_contents('resultHandle.html');
  $search=array("<p id=\"demo\"></p>");
  $replace=array("<table>$output</table>");
  $naa=str_replace($search,$replace, $aa);
  echo $naa;
  exit();

}

function error_handle($code){
  switch ($code) {
    case '0':
      $output= "SQL query failed";
      break;
    
    case '1':
      $output= "No data has been found.";
      break;
    
    default:
      $output="Unknown error occured";
      break;
  }
  $aa=file_get_contents('resultHandle.html');
  $search=array("<p id=\"demo\"></p>");
  $replace=array("<p>$output</p>");
  $naa=str_replace($search,$replace, $aa);

  echo $naa;
  
  exit();
}
/*unsolved:
▲may NEED to insert another html script to display the warning msg and a return button and a close window button
*/
/*unsolved
converse the returned data into json so that it can be transferred to the html page
 */
if ($table=="tn"){
 table(handle_firstTable($user));
 

  exit();
}else{
  table(handle_secondTable($user));
  
  exit();
}
/*
▲ SOLVED!NEED to consider when the text input is space(should be invalid)
BEETER to limit the GET content only be characters
*/

?>