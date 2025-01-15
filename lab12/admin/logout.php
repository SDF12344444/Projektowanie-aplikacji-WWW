<?php
// Rozpoczynamy sesję, aby mieć dostęp do danych sesji
session_start();  

// Usuwamy wszystkie dane przechowywane w zmiennych sesyjnych (np. login, id użytkownika itp.)
session_unset();  

// Zatrzymujemy sesję, czyli usuwamy całą sesję użytkownika
session_destroy();  

 // Przekierowujemy użytkownika na stronę logowania/admin.php
header('Location: admin.php'); 

// Kończymy skrypt, aby upewnić się, że nie zostaną wykonane dalsze operacje
exit;  
?>