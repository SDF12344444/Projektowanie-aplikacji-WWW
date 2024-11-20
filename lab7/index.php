<?php
include('cfg.php');
include('showpage.php');

error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);

$idp = $_GET['idp'] ?? ''; 

if (!empty($idp)) {
    $strona = PokazPodstrone($idp, $link);
} else {
    $strona = file_get_contents('html/glowna.html');
}

include 'html/header.html';
?>

<div id="content">
    <?php 
    echo $strona; 
    ?>
</div>

<?php
include 'html/footer.html';
?>
