<html>
<html lang="pl">
<head>
    <meta charset="UTF-8">

</head>
<body>
    <h1>Informacje o Użytkowniku</h1>
    <?php
        $nr_indeksu = '169356';
        $nrGrupy = '3';
        echo 'Adam Pyskło '.$nr_indeksu.' grupa '.$nrGrupy.' <br /><br />';
    ?>
    
     <?php
        echo "<h2>a)</h2>";

        echo "Zawartość pliku include(): <br>";
        include('1.php');

        echo "Zawartość pliku require_once(): <br>";
        require_once('2.php'); 
    ?>
   
     <?php
        echo "<h2>d)</h2>";

        
        echo "Przykład zmiennej \$_GET: <br>";
        if (isset($_GET['name'])) {
            $name = $_GET['name'];
            echo "$name <br>";
        } 

        echo "<br>Przykład zmiennej \$_POST: <br>";
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['name'])) {
                $name_post = $_POST['name'];
                echo "$name_post <br>";
            } 
        } 

        session_start();
        echo "<br>Przykład zmiennej \$_SESSION: <br>";
        if (!isset($_SESSION['counter'])) {
            $_SESSION['counter'] = 1;
        } else {
            $_SESSION['counter']++;
        }
        echo "Licznik sesji: ".$_SESSION['counter']."<br>";
    ?>
    
    <h2>Formularz testujący metodę GET</h2>
    <form action="labor_4_169356_3_ISI.php" method="GET">
        <label for="name">Wpisz swoje imię:</label><br>
        <input type="text" id="name" name="name"><br><br>
        <input type="submit" value="Wyślij">
    </form>
     <form action="labor_4_169356_3_ISI.php" method="POST">
        <label for="name">Wpisz swoje imię:</label><br>
        <input type="text" id="name" name="name"><br><br>
        <input type="submit" value="Wyślij">
    </form>
   
</body>
</html>
