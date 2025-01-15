<?php



function PokazProdukty($conn) {
    echo '<h2>Lista produktów</h2>';
    echo '<table border="1" cellpadding="10">';
    echo '<tr><th>Tytuł</th><th>Kategoria</th><th>Cena netto</th><th>VAT</th><th>Ilość</th><th>Dostępność</th><th>Opcje</th></tr>';

    // Pobranie wszystkich produktów
    $query = "SELECT * FROM products ORDER BY category ASC, title ASC";
    $result = $conn->query($query);

    while ($row = $result->fetch_assoc()) {
        $availability = $row['availability_status'] ? 'Dostępny' : 'Niedostępny';
        echo '<tr>';
        echo '<td>' . htmlspecialchars($row['title']) . '</td>';
        echo '<td>' . htmlspecialchars($row['category']) . '</td>';
        echo '<td>' . number_format($row['net_price'], 2) . '</td>';
        echo '<td>' . number_format($row['vat_rate'], 2) . '%</td>';
        echo '<td>' . $row['stock_quantity'] . '</td>';
        echo '<td>' . $availability . '</td>';
        echo '<td>
            <a href="?action=edit&id=' . $row['id'] . '">Edytuj</a> | 
            <a href="?action=delete&id=' . $row['id'] . '" onclick="return confirm(\'Czy na pewno chcesz usunąć ten produkt?\')">Usuń</a>
        </td>';
        echo '</tr>';
    }

    echo '</table>';
    echo '<br><a href="?action=addd">Dodaj nowy produkt</a>';
}

// Panel administracyjny
if (isset($_GET['action'])) {
    $action = $_GET['action'];

    switch ($action) {
        case 'addd':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                DodajProdukt($conn, $_POST);
                header("Location: admin.php");
                exit;
            }
            echo '<h2>Dodaj produkt</h2>';
            echo '<form method="post">';
            echo '<label for="title">Tytuł:</label>';
            echo '<input type="text" name="title" id="title" required><br><br>';
            echo '<label for="description">Opis:</label>';
            echo '<textarea name="description" id="description"></textarea><br><br>';
            echo '<label for="net_price">Cena netto:</label>';
            echo '<input type="number" name="net_price" id="net_price" step="0.01" required><br><br>';
            echo '<label for="vat_rate">Podatek VAT:</label>';
            echo '<input type="number" name="vat_rate" id="vat_rate" step="0.01" required><br><br>';
            echo '<label for="stock_quantity">Ilość:</label>';
            echo '<input type="number" name="stock_quantity" id="stock_quantity" required><br><br>';
            echo '<label for="availability_status">Dostępność:</label>';
            echo '<select name="availability_status" id="availability_status">';
            echo '<option value="1">Dostępny</option>';
            echo '<option value="0">Niedostępny</option>';
            echo '</select><br><br>';
            echo '<label for="category">Kategoria:</label>';
            echo '<input type="text" name="category" id="category"><br><br>';
            echo '<label for="product_size">Gabaryt:</label>';
            echo '<input type="text" name="product_size" id="product_size"><br><br>';
            echo '<label for="image_link">Link do zdjęcia:</label>';
            echo '<input type="text" name="image_link" id="image_link"><br><br>';
            echo '<button type="submit">Dodaj</button>';
            echo '</form>';
            break;

        case 'edit':
            if (isset($_GET['id']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
                EdytujProdukt($conn, $_GET['id'], $_POST);
                header("Location: admin.php");
                exit;
            }

            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $query = "SELECT * FROM products WHERE id = ?";
                $stmt = $conn->prepare($query);
                $stmt->bind_param("i", $id);
                $stmt->execute();
                $result = $stmt->get_result();
                $product = $result->fetch_assoc();

                echo '<h2>Edytuj produkt</h2>';
                echo '<form method="post">';
                foreach ($product as $key => $value) {
                    if ($key === 'id') continue; // Skip ID
                    echo "<label for=\"$key\">$key:</label>";
                    echo "<input type=\"text\" name=\"$key\" id=\"$key\" value=\"" . htmlspecialchars($value) . "\"><br><br>";
                }
                echo '<button type="submit">Zapisz zmiany</button>';
                echo '</form>';
            }
            break;

        case 'delete':
            if (isset($_GET['id'])) {
                UsunProdukt($conn, $_GET['id']);
                header("Location: admin.php");
                exit;
            }
            break;

        default:
            PokazProdukty($conn);
            break;
    }
} else {
    PokazProdukty($conn);
}


// Funkcje pomocnicze
function DodajProdukt($conn, $data) {
    $query = "INSERT INTO products (title, description, expiration_date, net_price, vat_rate, stock_quantity, availability_status, category, product_size, image_link)
              VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param(
        "sssdiissss",
        $data['title'], $data['description'], $data['expiration_date'],
        $data['net_price'], $data['vat_rate'], $data['stock_quantity'],
        $data['availability_status'], $data['category'], $data['product_size'],
        $data['image_link']
    );
    $stmt->execute();
}

function EdytujProdukt($conn, $id, $data) {
    $query = "UPDATE products SET title = ?, description = ?, expiration_date = ?, net_price = ?, vat_rate = ?, stock_quantity = ?, availability_status = ?, category = ?, product_size = ?, image_link = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param(
        "sssdiissssi",
        $data['title'], $data['description'], $data['expiration_date'],
        $data['net_price'], $data['vat_rate'], $data['stock_quantity'],
        $data['availability_status'], $data['category'], $data['product_size'],
        $data['image_link'], $id
    );
    $stmt->execute();
}

function UsunProdukt($conn, $id) {
    $query = "DELETE FROM products WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
}












?>