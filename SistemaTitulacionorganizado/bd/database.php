<?php
$dbHost = "localhost";
$dbUser = "root";
$dbPass = "1234";
$dbBase = "pruebaproyecto";

$db = new mysqli($dbHost, $dbUser, $dbPass, $dbBase);

if ($db->connect_error) {
    die("Conexion no lograda...: " . $conn->connect_error);
} 
?>