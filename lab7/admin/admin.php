<?php
include('C:\xampp\htdocs\cfg.php');

function FormularzLogowania($error = '') {
    echo '<div style="color: red; margin-bottom: 10px;">' . $error . '</div>';
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

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
        $user_login = $_POST['login'];
        $user_pass = $_POST['pass'];

        if ($user_login === $login && $user_pass === $pass) {
            $_SESSION['logged_in'] = true;
            header("Location: admin.php");
            exit;
        } else {
            FormularzLogowania('Nieprawidłowy login lub hasło.');
        }
    } else {
        FormularzLogowania();
    }
    exit;
}


function ListaPodstron($conn) {
    echo '<h2>Lista podstron</h2>';
    echo '<table border="1" cellpadding="10">';
    echo '<tr><th>ID</th><th>Tytuł podstrony</th><th>Opcje</th></tr>';

    $query = "SELECT id, page_title FROM page_list ORDER BY id ASC";
    $result = $conn->query($query);

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
    echo '<br><a href="?action=add">Dodaj nową podstronę</a>';
}

function EdytujPodstrone($conn, $id) {
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

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
        $title = $_POST['title'];
        $content = $_POST['content'];
        $status = isset($_POST['status']) ? 1 : 0;

        $update_query = "UPDATE page_list SET page_title = '$title', page_content = '$content', status = $status WHERE id = $id";
        $conn->query($update_query);

        echo '<p>Podstrona została zaktualizowana!</p>';
        header("Location: admin.php");
        exit;
    }
}

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

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add'])) {
        $title = $_POST['title'];
        $content = $_POST['content'];
        $status = isset($_POST['status']) ? 1 : 0;

        $insert_query = "INSERT INTO page_list (page_title, page_content, status) VALUES ('$title', '$content', $status)";
        $conn->query($insert_query);

        echo '<p>Nowa podstrona została dodana!</p>';
        header("Location: admin.php");
        exit;
    }
}

function UsunPodstrone($conn, $id) {
    $delete_query = "DELETE FROM page_list WHERE id = $id";
    $conn->query($delete_query);

    echo '<p>Podstrona została usunięta!</p>';
    header("Location: admin.php");
    exit;
}

if (isset($_GET['action'])) {
    $action = $_GET['action'];

    switch ($action) {
        case 'edit':
            if (isset($_GET['id'])) {
                EdytujPodstrone($conn, $_GET['id']);
            }
            break;
        case 'add':
            DodajNowaPodstrone($conn);
            break;
        case 'delete':
            if (isset($_GET['id'])) {
                UsunPodstrone($conn, $_GET['id']);
            }
            break;
        default:
            ListaPodstron($conn);
            break;
    }
} else {
    ListaPodstron($conn);
}

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: admin.php'); 
    exit;
}

echo '<a href="logout.php"><br>Wyloguj</a>'; 

?>
