<?php
session_start();
static $connection;
$servername = "localhost";
$username = "root";
$password = "mrugesh123";
$database = "bookingcalander";
$connection = mysqli_connect($servername,$username,$password,$database);

if (!$connection) {
	die("Connection failed: " . mysqli_connect_error());
}
?>