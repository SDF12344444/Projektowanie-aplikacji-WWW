<?php
// Wszystkie błędy oprócz Notice
error_reporting(E_ALL & ~E_NOTICE);

// Ładowanie plików konfiguracyjnych i funkcji
include('cfg.php');  
include('showpage.php');  

// Sprawdzany jest parametr idp 
$idp = isset($_GET['idp']) ? $_GET['idp'] : 'Stronagłówna'; 


// Pobieranie treści strony z bazy danych

// Funkcja PokazPodstrone wykonuje zapytanie do bazy danych
// w celu pobrania treści strony o danym tytule
$strona = PokazPodstrone($idp, $conn); 

include 'html/header.html'; // Wstawia nagłówek strony

?>

<div id="content">
    <?php 
    // Zmienna $strona zawiera treść pobraną z bazy
    echo $strona; 
    ?>
</div>

<?php
include 'html/footer.html';  // Wstawia stopkę strony
?>
<br>
<center>

<?php
    $nrindeksu  = 'Adam Pyskło' ;
    $nrGrupy = 3;
    echo "$nrindeksu grupa ISI $nrGrupy";
    ?>
    </center>