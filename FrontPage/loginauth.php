
<?php

require_once('connection.php');
connector("localhost","root","1234567","userdb");
session_get_cookie_params();
session_start();

$_SESSION['EXPIRES'] = time()+300;
$usn=$_POST["username"];
$psw=$_POST["password"];


/*
▲NEED to consider the situation when the username is duplicated?
ONLY the authorized users can access the search system page and see the datas
*/
$query="SELECT psword from accountls where username='$usn'";
$job=mysqli_query($GLOBALS['link'],$query);

while ($row=mysqli_fetch_assoc($job)){
    $set[]=$row;

}
if($set==NULL){
    echo"111";
    $msg= "User does not exist.";
    echo"<script type='text/javascript'>alert('$msg');
    window.location.href='loginpage.html'</script>
    ";
    /*echo '<script type="text/javascript">
    myFn();
   </script>';*/
    $GLOBALS['link'].close();
    exit();
}


if($psw!=$set[0]["psword"]){
    $msg= "Wrong password.";

    echo"<script type='text/javascript'>alert('$msg');
    window.location.href='loginpage.html'</script>
    ";
    $GLOBALS['link'].close();
    exit();
}
$_SESSION['token']=1234;
$_SESSION['username']=$usn;

header("Location: searchpage.html");
exit();
?>