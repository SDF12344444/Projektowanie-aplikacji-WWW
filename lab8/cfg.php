<?php
session_start(); 

$host = 'localhost';
$user = 'root';
$password = ''; 
$database = 'moja_strona';

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Błąd połączenia z bazą danych: " . $conn->connect_error);
}

$login = "admin"; 
$pass = "1234"; 
?>
