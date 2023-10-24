<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "task2";
$con = mysqli_connect($servername,$username,$password,$database);

if (!$con){
    die ("something wents wrong... <br>".mysqli_connect_error());
}



?>