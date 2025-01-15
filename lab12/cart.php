<?php
include 'cfg.php';


// Obsługa akcji koszyka
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_to_cart'])) {
        $product_id = $_POST['product_id'];
        $quantity = intval($_POST['quantity']);
        add_to_cart($product_id, $quantity);
    } elseif (isset($_POST['remove_from_cart'])) {
        $product_id = $_POST['product_id'];
        remove_from_cart($product_id);
    } elseif (isset($_POST['update_quantity'])) {
        $product_id = $_POST['product_id'];
        $quantity = intval($_POST['quantity']);
        update_quantity($product_id, $quantity);
    }
}

// Funkcje zarządzania koszykiem
function add_to_cart($product_id, $quantity) {
    global $conn;

    // Pobranie szczegółów produktu
    $query = "SELECT * FROM products WHERE id = ? AND availability_status = 1";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();

    if ($product) {
        // Sprawdzenie, czy produkt jest dostępny w wystarczającej ilości
        $available_stock = $product['stock_quantity'];
        if ($quantity > $available_stock) {
            echo '<p style="color: red;">Nie można dodać do koszyka więcej niż dostępnych ' . $available_stock . ' sztuk produktu.</p>';
            return;
        }

        if (isset($_SESSION['cart'][$product_id])) {
            $current_quantity = $_SESSION['cart'][$product_id]['quantity'];
            if ($current_quantity + $quantity > $available_stock) {
                echo '<p style="color: red;">Nie można dodać więcej sztuk produktu niż dostępnych w magazynie.</p>';
                return;
            }
            $_SESSION['cart'][$product_id]['quantity'] += $quantity;
        } else {
            $_SESSION['cart'][$product_id] = [
                'quantity' => $quantity // Przechowujemy tylko ilość w sesji
            ];
        }
    } else {
        echo '<p style="color: red;">Produkt jest niedostępny i nie można go dodać do koszyka.</p>';
    }
}

function remove_from_cart($product_id) {
    unset($_SESSION['cart'][$product_id]);
}

function update_quantity($product_id, $quantity) {
    global $conn;

    $query = "SELECT stock_quantity FROM products WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();

    if ($quantity <= 0) {
        remove_from_cart($product_id);
    } elseif ($product && $quantity > $product['stock_quantity']) {
        echo '<p style="color: red;">Nie można zaktualizować ilości. Brak wystarczającej ilości produktu w magazynie.</p>';
    } else {
        $_SESSION['cart'][$product_id]['quantity'] = $quantity;
    }
}

function calculate_cart_total() {
    global $conn;
    $total = 0;

    foreach ($_SESSION['cart'] as $product_id => $item) {
        $query = "SELECT net_price, vat_rate FROM products WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $product_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $product = $result->fetch_assoc();

        if ($product) {
            $brutto_price = $product['net_price'] * (1 + $product['vat_rate'] / 100);
            $total += $brutto_price * $item['quantity'];
        }
    }

    return $total;
}

// Wyświetlenie koszyka
echo '<h1>Twój koszyk</h1>';
if (!empty($_SESSION['cart'])) {
    echo '<table border="1" cellpadding="10">';
    echo '<tr><th>Produkt</th><th>Cena netto</th><th>VAT</th><th>Ilość</th><th>Cena brutto</th><th>Opcje</th></tr>';
    foreach ($_SESSION['cart'] as $product_id => $item) {
        $query = "SELECT title, net_price, vat_rate FROM products WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $product_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $product = $result->fetch_assoc();

        if ($product) {
            $brutto_price = $product['net_price'] * (1 + $product['vat_rate'] / 100);
            echo '<tr>';
            echo '<td>' . htmlspecialchars($product['title']) . '</td>';
            echo '<td>' . number_format($product['net_price'], 2) . ' PLN</td>';
            echo '<td>' . $product['vat_rate'] . '%</td>';
            echo '<td>
                <form method="post" action="">
                    <input type="hidden" name="product_id" value="' . $product_id . '">
                    <input type="number" name="quantity" value="' . $item['quantity'] . '" min="1">
                    <button type="submit" name="update_quantity">Aktualizuj</button>
                </form>
            </td>';
            echo '<td>' . number_format($brutto_price * $item['quantity'], 2) . ' PLN</td>';
            echo '<td>
                <form method="post" action="">
                    <input type="hidden" name="product_id" value="' . $product_id . '">
                    <button type="submit" name="remove_from_cart">Usuń</button>
                </form>
            </td>';
            echo '</tr>';
        }
    }
    echo '</table>';
    echo '<h3>Łączna wartość koszyka: ' . number_format(calculate_cart_total(), 2) . ' PLN</h3>';

} else {
    echo '<p>Twój koszyk jest pusty.</p>';
}

// Dodanie przycisku "Wróć na stronę główną"
echo '<br>';
echo '<a href="index.php" style="display: inline-block; padding: 10px 20px; background-color: #007bff; color: #fff; text-decoration: none; border-radius: 5px;">Wróć na stronę główną</a>';


?>
