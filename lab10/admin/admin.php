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
        echo '<tr>';
        echo '<td>' . $row['id'] . '</td>';
        echo '<td>' . htmlspecialchars($row['page_title']) . '</td>';
        echo '<td>
            <a href="?action=edit&id=' . $row['id'] . '">Edytuj</a> | 
            <a href="?action=delete&id=' . $row['id'] . '" onclick="return confirm(\'Czy na pewno chcesz usunąć?\')">Usuń</a>
        </td>';
        echo '</tr>';
    }

    echo '</table>';
    echo '<br><a href="?action=add">Dodaj nową podstronę</a>';  // Opcja dodania nowej podstrony
}


// Funkcja: EdytujPodstrone
// Pozwala na edytowanie tytułu i treści istniejącej podstrony

function EdytujPodstrone($conn, $id) {
    // Pobranie danych strony z bazy na podstawie ID
    $query = "SELECT * FROM page_list WHERE id = $id";
    $result = $conn->query($query);
    $row = $result->fetch_assoc();

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
        $update_query = "UPDATE page_list SET page_title = '$title', page_content = '$content', status = $status WHERE id = $id";
        $conn->query($update_query);

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

function UsunPodstrone($conn, $id) {
    // Zapytanie usuwające stronę z bazy
    $delete_query = "DELETE FROM page_list WHERE id = $id";
    $conn->query($delete_query);

    echo '<p>Podstrona została usunięta!</p>';
    header("Location: admin.php");  // Przekierowanie po usunięciu
    exit;
}


// Główna logika: Obsługuje różne akcje (edycja, dodanie, usunięcie)

if (isset($_GET['action'])) {
    $action = $_GET['action'];

    // Wybór akcji na podstawie wartości parametru 'action'
    switch ($action) {
        case 'edit':
            if (isset($_GET['id'])) {
                EdytujPodstrone($conn, $_GET['id']);  // Edytowanie podstrony
            }
            break;
        case 'add':
            DodajNowaPodstrone($conn);  // Dodanie nowej podstrony
            break;
        case 'delete':
            if (isset($_GET['id'])) {
                UsunPodstrone($conn, $_GET['id']);  // Usunięcie podstrony
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


// Link do wylogowania
echo '<a href="logout.php"><br>Wyloguj</a>'; 

?>
