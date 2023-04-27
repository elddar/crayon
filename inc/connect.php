<?php
$hostname = "localhost";
$user = "root";
$password = "";
$base = "crayon";

$connection = new mysqli("$hostname", "$user", "$password", "$base");

if($connection === false){
    die("Error." . $connection->connect_error);
}
?>