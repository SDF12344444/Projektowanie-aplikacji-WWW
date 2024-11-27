<?php
session_start();


function PokazKontakt($error = '') {
    $output = '';
    if (!empty($error)) {
        $output .= '<div style="color: red;">' . $error . '</div>';
    }
    $output .= '
    <form method="post" action="">
        <label for="temat">Temat:</label><br>
        <input type="text" name="temat" id="temat" required><br><br>

        <label for="tresc">Treść:</label><br>
        <textarea name="tresc" id="tresc" rows="5" required></textarea><br><br>

        <label for="email">Twój email:</label><br>
        <input type="email" name="email" id="email" required><br><br>

        <button type="submit" name="send_contact">Wyślij wiadomość</button>
    </form>
    ';
    return $output;
}


function WyslijMailKontakt($odbiorca) {
    if (empty($_POST['temat']) || empty($_POST['tresc']) || empty($_POST['email'])) {
        echo PokazKontakt('Wszystkie pola są wymagane!');
        return;
    }

    $mail = [];
    $mail['subject'] = $_POST['temat'];
    $mail['body'] = $_POST['tresc'];
    $mail['sender'] = $_POST['email'];
    $mail['recipient'] = $odbiorca;

    $header = "From: Formularz Kontaktowy <" . $mail['sender'] . ">\n";
    $header .= "MIME-Version: 1.0\nContent-type: text/plain; charset=utf-8\n";
    $header .= "Return-Path: <" . $mail['sender'] . ">\n";

    if (mail($mail['recipient'], $mail['subject'], $mail['body'], $header)) {
        echo '<div style="color: green;">Wiadomość została wysłana pomyślnie!</div>';
    } else {
        echo '<div style="color: red;">Błąd podczas wysyłania wiadomości.</div>';
    }
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['send_contact'])) {
    WyslijMailKontakt("admin@twojastrona.pl"); 
}

echo PokazKontakt();
?>
