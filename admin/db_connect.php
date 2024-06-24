<?php 

//$conn= new mysqli('localhost','root','','fos_db')or die("Could not connect to mysql".mysqli_error($con)); 
?>

<?php

$host = "localhost";
$username = "root";
$password = "";
$database = "fos_db";

//creating the database connection
$conn = mysqli_connect($host, $username,$password,$database);

//check database connection
if(!$conn){
    die("connection failed". mysqli_connect_error());
}

?>
