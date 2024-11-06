<?php
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);

if ($_GET['idp'] == '') {
    $strona = 'html/glowna.html'; // Default page
} elseif ($_GET['idp'] == 'podstrona1') {
    $strona = 'html/podstrona1.html';
} elseif ($_GET['idp'] == 'podstrona2') {
    $strona = 'html/podstrona2.html';
} elseif ($_GET['idp'] == 'komputer') {
    $strona = 'html/komputer.html';
} elseif ($_GET['idp'] == 'procesor') {
    $strona = 'html/procesor.html';
} elseif ($_GET['idp'] == 'karta_graficzna') {
    $strona = 'html/karta_graficzna.html';
} elseif ($_GET['idp'] == 'pamiec_ram') {
    $strona = 'html/pamięć_ram.html';
} elseif ($_GET['idp'] == 'dysk_twardy') {
    $strona = 'html/dysk_twardy.html';
} elseif ($_GET['idp'] == 'filmy') {
    $strona = 'html/filmy.html';
}else {
    $strona = 'html/error.html'; 
}

include 'html/header.html';
?>

<div id="content">
    <?php include($strona); ?>
</div>

<?php
include 'html/footer.html';
?>
