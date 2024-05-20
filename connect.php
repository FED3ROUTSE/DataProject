<?php
$database = 'dataproject';
$username = 'root';
$password = '';
$servername = 'localhost';

$conn = new mysqli($servername, $username, $password, $database);

if($conn -> connect_error){
    die("Connection failed: ". $conn -> connect_error);
}
?>