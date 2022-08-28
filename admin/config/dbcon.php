<?php
$info = array(
    'host' => 'localhost',
    'user' => 'root',
    'password' => '',
    'dbname' => 'db_smartpp_admin'
);
$con = mysqli_connect($info['host'], $info['user'], $info['password'], $info['dbname']) or die('Error connection database!');
mysqli_set_charset($con, 'utf8');


    if(!$con){
        header("Location: ../errors/dberror.php");
        die();


    }

?>