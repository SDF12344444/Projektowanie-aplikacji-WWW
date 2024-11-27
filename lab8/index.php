<?php
include('cfg.php');
include('showpage.php');


$idp = isset($_GET['idp']) ? $_GET['idp'] : 'Strona główna'; 


$strona = PokazPodstrone($idp, $conn);


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
