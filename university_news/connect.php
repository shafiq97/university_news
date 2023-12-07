<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
$server = "localhost";
$user = "root";
$password = "";
$db = "news";

$conn = mysqli_connect($server, "root", "", $db);
if (!$conn) {
    die("Connection Failed " . mysqli_connect_error());
}
