<?php
// Wszystkie błędy oprócz Notice
error_reporting(E_ALL & ~E_NOTICE);

// Ładowanie plików konfiguracyjnych i funkcji
include('cfg.php');  
include('showpage.php');  

// Sprawdzany jest parametr idp 
$idp = isset($_GET['idp']) ? $_GET['idp'] : 'Strona_główna'; 


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
// Wyświetlanie produktów
$query = "SELECT * FROM products WHERE availability_status = 1";
$result = $conn->query($query);

echo '<h1>Produkty</h1>';
if ($result->num_rows > 0) {
    echo '<table border="1" cellpadding="10">';
    echo '<tr><th>Produkt</th><th>Opis</th><th>Cena netto</th><th>VAT</th><th>Opcje</th></tr>';
    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . htmlspecialchars($row['title']) . '</td>';
        echo '<td>' . htmlspecialchars($row['description']) . '</td>';
        echo '<td>' . number_format($row['net_price'], 2) . ' PLN</td>';
        echo '<td>' . $row['vat_rate'] . '%</td>';
        echo '<td>
            <form method="post" action="cart.php">
                <input type="hidden" name="product_id" value="' . $row['id'] . '">
                <input type="number" name="quantity" value="1" min="1">
                <button type="submit" name="add_to_cart">Dodaj do koszyka</button>
            </form>
        </td>';
        echo '</tr>';
    }
    echo '</table>';
} else {
    echo '<p>Brak dostępnych produktów.</p>';
}


?>

    
    
<?php
    $nrindeksu  = 'Adam Pyskło' ;
    $nrGrupy = 3;
    echo "$nrindeksu grupa ISI $nrGrupy";
    ?>
    </center>