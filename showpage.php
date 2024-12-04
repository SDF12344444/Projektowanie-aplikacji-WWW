<?php
include('cfg.php'); 

// Funkcja do pobierania zawartości strony na podstawie tytułu
function PokazPodstrone($title, $conn) {

    // Oczyszczenie tytułu strony, aby zapobiec atakom SQL Injection
    $title_clear = mysqli_real_escape_string($conn, htmlspecialchars($title));

    // Zapytanie SQL do pobrania strony na podstawie tytułu
    $query = "SELECT * FROM page_list WHERE page_title='$title_clear' AND status = 1 LIMIT 1";
    $result = mysqli_query($conn, $query);

    // Sprawdzenie, czy zapytanie zwróciło wynik
    if ($row = mysqli_fetch_assoc($result)) {
        return $row['page_content']; 
    } else {
        return "[Nie znaleziono strony o podanym tytule]"; 
    }
}
?>
