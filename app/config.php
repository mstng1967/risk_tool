<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
#define('DB_SERVER', 'mysql');
#define('DB_USERNAME', 'root');
#define('DB_PASSWORD', 'super-secret-password');
#define('DB_NAME', 'my-wonderful-website');
 
$host = "mysql"; /* Host name */
$user = "root"; /* User */
$password = "super-secret-password"; /* Password */
$dbname = "risktooldb"; /* Database name */
 
/* Attempt to connect to MySQL database */
#$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Check connection
#if($link === false){
#    die("ERROR: Could not connect. " . mysqli_connect_error());
#}
$con = mysqli_connect($host, $user, $password,$dbname);
// Check connection
if (!$con) {
 die("Connection failed: " . mysqli_connect_error());
}
?>
