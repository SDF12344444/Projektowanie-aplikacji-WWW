<?php

// Rozpoczęcie sesji użytkownika
session_start(); 

// Ustawienia połączenia z bazą danych
$host = 'localhost';      
$user = 'root';            
$password = '';           
$database = 'moja_strona'; 

// Tworzymy połączenie z bazą danych
$conn = new mysqli($host, $user, $password, $database);

// Dane logowania 
$login = "admin"; 
$pass = "1234"; 
?>
