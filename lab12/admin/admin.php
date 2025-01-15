<?php
// Dołączenie pliku konfiguracyjnego (połączenie z bazą danych i ustawienia sesji)
include('C:\xampp\htdocs\cfg.php');

// Funkcja: FormularzLogowania
// Wyświetla formularz logowania z opcjonalnym komunikatem o błędzie

function FormularzLogowania($error = '') {
    // Wyświetlenie komunikatu o błędzie, jeśli jest podany
    echo '<div style="color: red; margin-bottom: 10px;">' . $error . '</div>';

    // Formularz logowania
    echo '
        <form method="post" action="">
            <label for="login">Login:</label>
            <input type="text" name="login" id="login" required>
            <br><br>
            <label for="pass">Hasło:</label>
            <input type="password" name="pass" id="pass" required>
            <br><br>
            <button type="submit" name="submit">Zaloguj</button>
        </form>
    ';
}


// Logika logowania użytkownika

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
        // Pobranie danych wprowadzonych przez użytkownika
        $user_login = $_POST['login'];
        $user_pass = $_POST['pass'];

        // Walidacja loginu i hasła
        if ($user_login === $login && $user_pass === $pass) {
            $_SESSION['logged_in'] = true;  // Ustawienie sesji na zalogowaną
            header("Location: admin.php");  // Przekierowanie na stronę admina
            exit;
        } else {
            FormularzLogowania('Nieprawidłowy login lub hasło.');  // Wyświetlenie komunikatu o błędzie
        }
    } else {
        FormularzLogowania();  // Wyświetlenie formularza logowania
    }
    exit;
}


// Funkcja: ListaPodstron
// Wyświetla listę stron w bazie danych z opcjami edytowania i usuwania
function ListaPodstron($conn) {
    echo '<h2>Lista podstron</h2>';
    echo '<table border="1" cellpadding="10">';
    echo '<tr><th>ID</th><th>Tytuł podstrony</th><th>Opcje</th></tr>';

    // Pobranie listy stron z bazy danych
    $query = "SELECT id, page_title FROM page_list ORDER BY id ASC";
    $result = $conn->query($query);

    // Pętla po wynikach i wyświetlanie informacji o stronach
    while ($row = $result->fetch_assoc()) {
        $encodedTitle = urlencode($row['page_title']); 
        echo '<tr>';
        echo '<td>' . $row['id'] . '</td>';
        echo '<td>' . htmlspecialchars($row['page_title']) . '</td>';
        echo '<td>
            <a href="?action=edit&page_title=' . $encodedTitle . '">Edytuj</a> | 
            <a href="?action=delete&page_title=' . $encodedTitle . '" onclick="return confirm(\'Czy na pewno chcesz usunąć?\')">Usuń</a>
        </td>';
        echo '</tr>';
    }

    echo '</table>';
    echo '<br><a href="?action=add">Dodaj nową podstronę</a>';  
}

// Funkcja: EdytujPodstrone
// Pozwala na edytowanie tytułu i treści istniejącej podstrony
function EdytujPodstrone($conn, $pageTitle) {
    // Pobranie danych strony z bazy na podstawie page_title
    $decodedTitle = urldecode($pageTitle); 
    $query = "SELECT * FROM page_list WHERE page_title = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $decodedTitle);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if (!$row) {
        echo '<p>Podstrona nie istnieje.</p>';
        return;
    }

    echo '<h2>Edytuj podstronę</h2>';
    echo '
        <form method="post" action="">
            <label for="title">Tytuł:</label>
            <input type="text" name="title" id="title" value="' . htmlspecialchars($row['page_title']) . '" required>
            <br><br>
            <label for="content">Treść:</label>
            <textarea name="content" id="content" required>' . htmlspecialchars($row['page_content']) . '</textarea>
            <br><br>
            <label for="status">Aktywna:</label>
            <input type="checkbox" name="status" id="status" ' . ($row['status'] ? 'checked' : '') . '>
            <br><br>
            <button type="submit" name="update">Zapisz zmiany</button>
        </form>
    ';

    // Zaktualizowanie strony po wysłaniu formularza
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
        $title = $_POST['title'];
        $content = $_POST['content'];
        $status = isset($_POST['status']) ? 1 : 0;

        // Zapytanie aktualizujące dane strony w bazie
        $update_query = "UPDATE page_list SET page_title = ?, page_content = ?, status = ? WHERE page_title = ?";
        $stmt = $conn->prepare($update_query);
        $stmt->bind_param("ssis", $title, $content, $status, $decodedTitle);
        $stmt->execute();

        echo '<p>Podstrona została zaktualizowana!</p>';
        header("Location: admin.php");  // Przekierowanie po zapisaniu zmian
        exit;
    }
}

// Funkcja: DodajNowaPodstrone
// Pozwala na dodanie nowej podstrony na stronie

function DodajNowaPodstrone($conn) {
    echo '<h2>Dodaj nową podstronę</h2>';
    echo '
        <form method="post" action="">
            <label for="title">Tytuł:</label>
            <input type="text" name="title" id="title" required>
            <br><br>
            <label for="content">Treść:</label>
            <textarea name="content" id="content" required></textarea>
            <br><br>
            <label for="status">Aktywna:</label>
            <input type="checkbox" name="status" id="status">
            <br><br>
            <button type="submit" name="add">Dodaj podstronę</button>
        </form>
    ';

    // Dodanie nowej podstrony po wysłaniu formularza
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add'])) {
        $title = $_POST['title'];
        $content = $_POST['content'];
        $status = isset($_POST['status']) ? 1 : 0;

        // Zapytanie do bazy, aby dodać nową stronę
        $insert_query = "INSERT INTO page_list (page_title, page_content, status) VALUES ('$title', '$content', $status)";
        $conn->query($insert_query);

        echo '<p>Nowa podstrona została dodana!</p>';
        header("Location: admin.php");  // Przekierowanie po dodaniu podstrony
        exit;
    }
}

// Funkcja: UsunPodstrone
// Usuwa stronę na podstawie jej ID
function UsunPodstrone($conn, $pageTitle) {
    $decodedTitle = urldecode($pageTitle); // Dekodowanie tytułu z URL
    $delete_query = "DELETE FROM page_list WHERE page_title = ?";
    $stmt = $conn->prepare($delete_query);
    $stmt->bind_param("s", $decodedTitle);
    $stmt->execute();

    echo '<p>Podstrona została usunięta!</p>';
    header("Location: admin.php");  // Przekierowanie po usunięciu
    exit;
}



// Główna logika: Obsługuje różne akcje (edycja, dodanie, usunięcie)
if (isset($_GET['action'])) {
    $action = $_GET['action'];

    switch ($action) {
        case 'edit':
            if (isset($_GET['page_title'])) {
                EdytujPodstrone($conn, $_GET['page_title']);  // Edytowanie podstrony
            }
            break;
        case 'add':
            DodajNowaPodstrone($conn);  // Dodanie nowej podstrony
            break;
        case 'delete':
            if (isset($_GET['page_title'])) {
                UsunPodstrone($conn, $_GET['page_title']);  // Usunięcie podstrony
            }
            break;
        default:
            ListaPodstron($conn);  // Wyświetlenie listy podstron
            break;
    }
} else {
    ListaPodstron($conn);  // Domyślna akcja to wyświetlenie listy podstron
}

// Sprawdzanie sesji i wylogowanie

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: admin.php');  // Przekierowanie, jeśli użytkownik nie jest zalogowany
    exit;
}



include('categories.php');
include('products.php');

// Link do wylogowania
echo '<a href="logout.php"><br>Wyloguj</a>'; 

?>
