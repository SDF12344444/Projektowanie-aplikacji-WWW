 <?php
     echo "<h2>b)</h2>";

        $liczba = 25;
        echo "Przykład z if/else/elseif: <br>";
        if ($liczba > 0) {
            echo "Liczba jestdodatnia <br>";
        } elseif ($liczba < 0) {
            echo "Liczba jest ujemna 5<br>";
        } else {
            echo "Liczba jest równa 0<br>";
        }
    echo "<br>Przykład switch: <br>";
        $kolor = "zielony";
        switch ($kolor) {
            case "czerwony":
                echo "Kolor to czerwony<br>";
                break;
            case "zielony":
                echo "Kolor to zielony<br>";
                break;
            case "niebieski":
                echo "Kolor to niebieski<br>";
                break;
            default:
                echo "Nieznany kolor<br>";
        }
    ?>