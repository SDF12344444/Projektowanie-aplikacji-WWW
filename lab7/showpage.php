<?php
include('cfg.php'); 

function PokazPodstrone($title, $link) {

    $title_clear = mysqli_real_escape_string($link, htmlspecialchars($title));

    $query = "SELECT * FROM page_list WHERE page_title='$title_clear' AND status = 1 LIMIT 1";
    $result = mysqli_query($link, $query);

    if ($result && $row = mysqli_fetch_assoc($result)) {
        return $row['page_content']; 
    } else {
        return "[nie_znaleziono_strony]"; 
    }
}
?>
