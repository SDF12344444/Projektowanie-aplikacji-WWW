<?php
function PokazKategorie($conn) {
    echo '<h2>Lista kategorii</h2>';
    echo '<table border="1" cellpadding="10">';
    echo '<tr><th>Nazwa</th><th>Nadrzędna</th><th>Opcje</th></tr>';

    // Pobranie wszystkich kategorii
    $query = "SELECT c1.id, c1.name, c2.name AS parent_name 
              FROM categories c1 
              LEFT JOIN categories c2 ON c1.parent_id = c2.id 
              ORDER BY c1.parent_id ASC, c1.name ASC";
    $result = $conn->query($query);

    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . htmlspecialchars($row['name']) . '</td>';
        echo '<td>' . htmlspecialchars($row['parent_name'] ?? 'Brak') . '</td>';
        echo '<td>
            <a href="?action=edit&name=' . urlencode($row['name']) . '">Edytuj</a> | 
            <a href="?action=delete&name=' . urlencode($row['name']) . '" onclick="return confirm(\'Czy na pewno chcesz usunąć tę kategorię?\')">Usuń</a>
        </td>';
        echo '</tr>';
    }

    echo '</table>';
    echo '<br><a href="?action=add">Dodaj nową kategorię</a>';
}

// =========================
// Panel administracyjny
// =========================
if (isset($_GET['action'])) {
    $action = $_GET['action'];

    switch ($action) {
        case 'add':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                DodajKategorie($conn, $_POST['name'], $_POST['parent_id']);
                header("Location: admin.php");
                exit;
            }
            echo '<h2>Dodaj kategorię</h2>';
            echo '<form method="post">';
            echo '<label for="name">Nazwa kategorii:</label>';
            echo '<input type="text" name="name" id="name" required><br><br>';
            echo '<label for="parent_id">Kategoria nadrzędna:</label>';
            echo '<select name="parent_id" id="parent_id">';
            echo '<option value="0">Brak</option>';

            // Pobierz istniejące kategorie
            $query = "SELECT id, name FROM categories WHERE parent_id = 0";
            $result = $conn->query($query);
            while ($row = $result->fetch_assoc()) {
                echo '<option value="' . $row['id'] . '">' . htmlspecialchars($row['name']) . '</option>';
            }

            echo '</select><br><br>';
            echo '<button type="submit">Dodaj</button>';
            echo '</form>';
            break;

        case 'edit':
            if (isset($_GET['name']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
                EdytujKategorie($conn, $_GET['name'], $_POST['name'], $_POST['parent_id']);
                header("Location: admin.php");
                exit;
            }

            if (isset($_GET['name'])) {
                $name = $_GET['name'];
                $query = "SELECT * FROM categories WHERE name = ?";
                $stmt = $conn->prepare($query);
                $stmt->bind_param("s", $name);
                $stmt->execute();
                $result = $stmt->get_result();
                $category = $result->fetch_assoc();

                echo '<h2>Edytuj kategorię</h2>';
                echo '<form method="post">';
                echo '<label for="name">Nazwa kategorii:</label>';
                echo '<input type="text" name="name" id="name" value="' . htmlspecialchars($category['name']) . '" required><br><br>';
                echo '<label for="parent_id">Kategoria nadrzędna:</label>';
                echo '<select name="parent_id" id="parent_id">';
                echo '<option value="0">Brak</option>';

                // Pobierz istniejące kategorie
                $query = "SELECT id, name FROM categories WHERE parent_id = 0";
                $result = $conn->query($query);
                while ($row = $result->fetch_assoc()) {
                    $selected = $row['id'] == $category['parent_id'] ? 'selected' : '';
                    echo '<option value="' . $row['id'] . '" ' . $selected . '>' . htmlspecialchars($row['name']) . '</option>';
                }

                echo '</select><br><br>';
                echo '<button type="submit">Zapisz zmiany</button>';
                echo '</form>';
            }
            break;

        case 'delete':
            if (isset($_GET['name'])) {
                UsunKategorie($conn, $_GET['name']);
                header("Location: admin.php");
                exit;
            }
            break;

        default:
            PokazKategorie($conn);
            break;
    }
} else {
    PokazKategorie($conn);
}

// Funkcje pomocnicze
function DodajKategorie($conn, $name, $parent_id) {
    $query = "INSERT INTO categories (name, parent_id) VALUES (?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("si", $name, $parent_id);
    $stmt->execute();
}

function EdytujKategorie($conn, $old_name, $new_name, $parent_id) {
    $query = "UPDATE categories SET name = ?, parent_id = ? WHERE name = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sis", $new_name, $parent_id, $old_name);
    $stmt->execute();
}

function UsunKategorie($conn, $name) {
    $query = "DELETE FROM categories WHERE name = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $name);
    $stmt->execute();
}



function GenerujDrzewoKategorii($conn, $parentId = 0) {
    // Pobiera kategorie, które mają jako nadrzędną kategorię $parentId
    $query = "SELECT id, name FROM categories WHERE parent_id = ? ORDER BY name ASC";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $parentId);
    $stmt->execute();
    $result = $stmt->get_result();

    // Jeśli istnieją kategorie dla danego parentId, generuj listę
    if ($result->num_rows > 0) {
        echo '<ul>';
        while ($row = $result->fetch_assoc()) {
            echo '<li>' . htmlspecialchars($row['name']);
            // Rekurencyjnie generuje podkategorie dla aktualnej kategorii
            GenerujDrzewoKategorii($conn, $row['id']);
            echo '</li>';
        }
        echo '</ul>';
    }
}

// Wywołanie funkcji na poziomie głównym (root categories)
echo '<h2>Drzewo kategorii</h2>';
GenerujDrzewoKategorii($conn);




?>
