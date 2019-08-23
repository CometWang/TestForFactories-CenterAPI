<html>
<body>
<?php

// Check if one of the student name links was clicked

if(isset($_GET["action"]) == "get_student"){
    
    // Get the specific student data
    
    $student_info = file_get_contents('http://localhost/test/api.php?action=get_student&id=' . $_GET["id"]);
    
    // Decode from JSON into an array
    echo $student_info. "<br/>";
   $student_info = json_decode($student_info, true);
  

    
?>

First Name : <?php
//use ["first_name"]as index to the student_info array and print the certain key value
 echo $student_info["first_name"] ?><br /> 

Last Name : <?php echo $student_info["last_name"] ?><br />
Address : <?php echo $student_info["address"] ?><br />

<?php

}

 else // else print out the list of students
 
 {
    
    // Call the method get_student_list in the API to get the list
    
    $student_list = file_get_contents('http://localhost/test/api.php?action=get_student_list');
    
    // Convert from JSON and into an array
    
    $student_list = json_decode($student_list, true);
    
?>

<!-- Cycle through the student list and print them out with the correct id -->

<?php foreach($student_list as $student): ?>

<a href=<?php echo
"http://localhost/test/client_code.php?action=get_student&id=" . $student["id"] ?>><?php echo $student["name"] ?></a><br />
 
 <?php endforeach; ?>
 
 <?php
    
 } ?>

</body>
</html>