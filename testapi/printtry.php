<?php
$response_data['amount_of_trans']=1;
 $insertAmount=3;
$result="Incorrect number ". $response_data['amount_of_trans']. " of inserting! Suppose to insert" . $response_data['amount_of_trans'] . "numbers of data. Only " . $insertAmount . " of data have been inserted!";

echo gettype($result);
echo $result;
?>