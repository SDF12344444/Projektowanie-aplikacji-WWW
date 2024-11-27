<?php
include('cfg.php'); 

function PokazPodstrone($title, $conn) {
    if (!$conn) {
        return "[Błąd połączenia z bazą danych]";
    }

    $title_clear = mysqli_real_escape_string($conn, htmlspecialchars($title));

    $query = "SELECT * FROM page_list WHERE page_title='$title_clear' AND status = 1 LIMIT 1";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        return "[Błąd zapytania SQL]: " . mysqli_error($conn);
    }

    if ($row = mysqli_fetch_assoc($result)) {
        return $row['page_content'];
    } else {
        return "[Nie znaleziono strony o podanym tytule]";
    }
}
?>
