<?php
$host="localhost";
$password="";
$user="root";
$db_name="db_store";
 $con=mysqli_connect($host,$user, $password, $db_name) or die();
 $conn=new PDO("mysql: host=localhost;dbname=db_store","root","") or die();
?>