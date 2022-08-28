<?php

$con = new mysqli("localhost","root","","db_smartpp_admin");
if($con->connect_error){
    die("Faile to connect.".$con->connect_error);
}

$json=array();

$sql="SELECT * FROM equipment_name";
$stmt=$con->prepare($sql);
$stmt->execute();
$result= $stmt->get_result();

// print_r($result);

// echo('pre');
while($row=$result->fetch_assoc()){
    // print_r($row);
    array_push($json,$row);
}

echo json_encode($json);



?>