-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 11, 2024 at 12:49 PM
-- Wersja serwera: 10.4.32-MariaDB
-- Wersja PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `moja_strona`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `page_list`
--

CREATE TABLE `page_list` (
  `id` int(11) NOT NULL,
  `page_title` varchar(255) NOT NULL,
  `page_content` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `page_list`
--

INSERT INTO `page_list` (`id`, `page_title`, `page_content`, `status`) VALUES
(1, 'Strona_główna', '\r\n\r\n<center>\r\n    <h1>Zmień kolor tła</h1>\r\n    <form method=\"POST\" name=\"tło\">\r\n        <input type=\"button\" value=\"Żółty\" onclick=\"changeBackground(\'#FFF000\')\">\r\n        <input type=\"button\" value=\"Czarny\" onclick=\"changeBackground(\'#000000\')\">\r\n        <input type=\"button\" value=\"Biały\" onclick=\"changeBackground(\'#FFFFFF\')\">\r\n        <input type=\"button\" value=\"Zielony\" onclick=\"changeBackground(\'#00FF00\')\">\r\n        <input type=\"button\" value=\"Niebieski\" onclick=\"changeBackground(\'#0000FF\')\">\r\n        <input type=\"button\" value=\"Fioletowy\" onclick=\"changeBackground(\'#B803FF\')\">\r\n        <input type=\"button\" value=\"Pomarańczowy\" onclick=\"changeBackground(\'#FF8000\')\">\r\n        <input type=\"button\" value=\"Szary\" onclick=\"changeBackground(\'#C0C0C0\')\">\r\n        <input type=\"button\" value=\"Czerwony\" onclick=\"changeBackground(\'#FF0000\')\">\r\n        <input type=\"button\" value=\"Jasny zielony\" onclick=\"changeBackground(\'rgb(144, 238, 144)\')\">\r\n    </form>\r\n    \r\n    <br>\r\n    <div id=\"animacjaTestowa1\"><h1>Zegarek</h1></div>\r\n\r\n    <form method=\"POST\" name=\"czas\">\r\n        <input type=\"button\" value=\"Zatrzymaj zegarek\" onclick=\"stopclock()\">\r\n        <input type=\"button\" value=\"Wznów zegarek\" onclick=\"startclock()\">\r\n    </form>\r\n    \r\n    <div id=\"animacjaTestowa3\" class=\"test-block\">\r\n        <div id=\"zegarek\"></div>  \r\n        <div id=\"data\"></div>\r\n    </div>\r\n\r\n    <br>\r\n    <center>\r\n<div><b>\r\nKomputer</b> <i>(od ang. computer)</i>; dawniej: mózg elektronowy, elektroniczna maszyna cyfrowa, maszyna matematyczna– maszyna przeznaczona do przetwarzania informacji, które da się zapisać w formie ciągu cyfr albo sygnału ciągłego. Maszyna roku tygodnika „Time” w 1982 roku.\r\n\r\nMimo że mechaniczne maszyny liczące istniały od wielu stuleci, komputery w sensie współczesnym pojawiły się dopiero w połowie XX wieku, gdy zbudowano pierwsze komputery elektroniczne.<br><img  src=\"http://localhost/img/e.jpg\"  width=\"300\" height=\"300\"><br> Miały one rozmiary sporych pomieszczeń i zużywały kilkaset razy więcej energii niż współczesne komputery osobiste <u>(PC)</u>, a jednocześnie miały miliardy razy mniejszą moc obliczeniową. Współcześnie są prowadzone także badania nad komputerami biologicznymi i optycznymi.\r\n\r\nMałe komputery mogą zmieścić się nawet w zegarku i są zasilane baterią. Komputery osobiste stały się symbolem ery informatycznej. Najliczniejszymi maszynami liczącymi są systemy wbudowane sterujące najróżniejszymi urządzeniami – od odtwarzaczy MP3 i zabawek po roboty przemysłowe.\r\n</div>\r\n</center>\r\n<br>\r\n<div>\r\n\r\n\r\n\r\n<center>\r\n\r\n<img  src=\"http://localhost/img/e8.jpg\"  width=\"300\" height=\"300\">\r\n<img  src=\"http://localhost/img/e9.jpg\"  width=\"300\" height=\"300\">\r\n<img  src=\"http://localhost/img/e10.jpg\"  width=\"300\" height=\"300\">\r\n<img  src=\"http://localhost/img/e11.jpg\"  width=\"300\" height=\"300\">\r\n</center>\r\n</div>\r\n\r\n \r\n    <center><h1>Kontakt</h1>\r\n<form action=\"mailto:mail@.com\" method=\"post\" enctype=\"text/plain\"><div>\r\n<input name=\"Imię i Nazwisko\">Imię i Nazwisko<br>\r\n<p>Płeć:</p>\r\n<input type=\"radio\" name=\"Płeć\" value=\"Kobieta\">Kobieta\r\n<input type=\"radio\" name=\"Płeć\" value=\"Mężczyzna\">Mężczyzna\r\n<p>Napisz wiadomość:</p>\r\n<textarea name=\"Komentarz\" cols=\"50\" rows=\"10\"></textarea>\r\n<br><br><br>\r\n<input type=\"submit\" value=\"Wyślij formularz\">\r\n</div></form>\r\n<div id=\"animacjaTestowa2\" class=\"test-block\">Najedź kursorem, a się powiększę</div>\r\n</center>\r\n', 1),
(2, 'Komputer', ' <center>\r\n<h1>Informacje o Komputerze</h1>\r\n</center>\r\n\r\n    <div>\r\n        <p>\r\n            Komputer to urządzenie elektroniczne przeznaczone do przetwarzania danych. Jego główne komponenty\r\n            to procesor (CPU), pamięć operacyjna (RAM), pamięć masowa (HDD lub SSD) oraz płyta główna. Dzięki\r\n            zastosowaniu systemów operacyjnych, takich jak Windows, Linux czy macOS, komputer staje się wszechstronnym\r\n            narzędziem do pracy, rozrywki i komunikacji.\r\n        </p>\r\n<center>\r\n        <div>\r\n            <img src=\"http://localhost/img/e1.jpg\" width=\"300\" height=\"300\" alt=\"Obraz 1\">\r\n            <img src=\"http://localhost/img/e2.jpg\" width=\"300\" height=\"300\" alt=\"Obraz 2\">\r\n            <img src=\"http://localhost/img/e3.jpg\" width=\"300\" height=\"300\" alt=\"Obraz 3\">\r\n            <img src=\"http://localhost/img/e4.jpg\" width=\"300\" height=\"300\" alt=\"Obraz 4\">\r\n        </div>\r\n    </div>\r\n</center>\r\n', 1),
(3, 'Procesor', '<center>\r\n <h1>Informacje o Procesorach</h1>\r\n</center>\r\n\r\n    <div >\r\n        <p>\r\n            Procesor (CPU - Central Processing Unit) jest sercem każdego komputera. To on odpowiada za wykonywanie\r\n            instrukcji programowych, przetwarzanie danych i zarządzanie przepływem informacji pomiędzy różnymi komponentami\r\n            systemu. Współczesne procesory, takie jak Intel Core czy AMD Ryzen, charakteryzują się wieloma rdzeniami i\r\n            wysoką wydajnością, umożliwiając płynne działanie aplikacji i gier. Kluczowe parametry procesorów to częstotliwość\r\n            taktowania, liczba rdzeni i wątków, a także pamięć cache.\r\n        </p>\r\n<center>\r\n        <div>\r\n            <img src=\"http://localhost/img/e55.jpg\" width=\"300\" height=\"300\" alt=\"Procesor obraz 1\">\r\n            <img src=\"http://localhost/img/e66.jpg\" width=\"300\" height=\"300\" alt=\"Procesor obraz 2\">\r\n            <img src=\"http://localhost/img/e77.jpg\" width=\"300\" height=\"300\" alt=\"Procesor obraz 3\">\r\n        </div>\r\n    </div>\r\n</center>', 1),
(4, 'Karta_Graficzna', '<center>\r\n<h1>Informacje o Kartach Graficznych</h1>\r\n</center>\r\n    <div>\r\n        <p>\r\n            Karta graficzna (GPU - Graphics Processing Unit) to kluczowy komponent komputera odpowiedzialny za\r\n            przetwarzanie grafiki i wyświetlanie obrazu na ekranie. Nowoczesne karty graficzne, takie jak NVIDIA\r\n            GeForce RTX lub AMD Radeon RX, oferują zaawansowane technologie, takie jak ray tracing, które poprawiają\r\n            jakość grafiki w grach i aplikacjach graficznych. Główne parametry kart graficznych obejmują ilość pamięci\r\n            VRAM, szybkość taktowania GPU oraz ilość rdzeni CUDA lub stream processors.\r\n        </p>\r\n<center>\r\n        <div>\r\n            <img src=\"http://localhost/img/e88.jpg\" width=\"300\" height=\"300\" alt=\"Karta Graficzna 1\">\r\n            <img src=\"http://localhost/img/e99.jpg\" width=\"300\" height=\"300\" alt=\"Karta Graficzna 2\">\r\n            <img src=\"http://localhost/img/e100.jpg\" width=\"300\" height=\"300\" alt=\"Karta Graficzna 3\">\r\n        </div>\r\n    </div>\r\n</center>\r\n', 1),
(5, 'Pamięć_RAM', '<center>\r\n  <h1>Informacje o Pamięci RAM</h1>\r\n</center>\r\n\r\n    <div>\r\n        <p>\r\n            Pamięć RAM (Random Access Memory) jest jednym z kluczowych komponentów komputera, odpowiedzialnym za\r\n            przechowywanie danych, które są aktualnie używane przez system operacyjny i aplikacje. RAM charakteryzuje się\r\n            wysoką prędkością dostępu, co czyni ją idealnym miejscem do przechowywania tymczasowych informacji. Współczesne\r\n            moduły RAM, takie jak DDR4 i DDR5, oferują dużą przepustowość i pojemności sięgające nawet kilkudziesięciu GB.\r\n            Wydajna pamięć RAM wpływa bezpośrednio na płynność działania programów i gier.\r\n        </p>\r\n<center>\r\n        <div>\r\n            <img src=\"http://localhost/img/111.jpg\" width=\"300\" height=\"300\" alt=\"RAM 1\">\r\n            <img src=\"http://localhost/img/122.jpg\" width=\"300\" height=\"300\" alt=\"RAM 2\">\r\n            <img src=\"http://localhost/img/133.jpg\" width=\"300\" height=\"300\" alt=\"RAM 3\">\r\n        </div>\r\n    </div>\r\n</center>\r\n', 1),
(6, 'Dysk_twardy', '\r\n<center>\r\n <h1>Informacje o Dyskach Twardych</h1>\r\n</center>\r\n\r\n\r\n    <div>\r\n        <p>\r\n            Dysk twardy (HDD - Hard Disk Drive) to urządzenie służące do przechowywania danych w komputerze. Jest on \r\n            jednym z podstawowych elementów sprzętu komputerowego, odpowiedzialnym za przechowywanie systemu operacyjnego, \r\n            aplikacji i plików użytkownika. Tradycyjne dyski HDD oferują duże pojemności w przystępnej cenie, choć są \r\n            wolniejsze od nowszych technologii, takich jak SSD. Wybór odpowiedniego dysku zależy od potrzeb użytkownika — \r\n            czy priorytetem jest pojemność, szybkość czy cena.\r\n        </p>\r\n<center>\r\n        <div>\r\n            <img src=\"http://localhost/img/1.jpg\" width=\"300\" height=\"300\" alt=\"Dysk Twardy 1\">\r\n            <img src=\"http://localhost/img/2.jpg\" width=\"300\" height=\"300\" alt=\"Dysk Twardy 2\">\r\n            <img src=\"http://localhost/img/3.jpg\" width=\"300\" height=\"300\" alt=\"Dysk Twardy 3\">\r\n        </div>\r\n    </div>\r\n</center>', 1),
(7, 'Filmy', '<center>\r\n<h1>Filmy</h1>\r\n\r\n<h2>Ewolucja Komputerów</h2>\r\n<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/watch?v=CkTQqBvA9WI&pp=ygUUZXdvbHVjamEga29tcHV0ZXLDs3c%3D\" \r\n        allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" \r\n        allowfullscreen></iframe>\r\n\r\n<h2>Jak Powstają Procesory</h2>\r\n<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/watch?v=MTUy8iJmWsQ&pp=ygUVcHJvZHVrY2phIHByb2Nlc29yw7N3\" \r\n        allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" \r\n        allowfullscreen></iframe>\r\n\r\n<h2>Jak powstają karty graficzne</h2>\r\n<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/watch?v=y3uh7s3Scuo&pp=ygUdSmFrIHBvd3N0YWrEhSBrYXJ0eSBncmFmaWN6bmU%3D\" \r\n        allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" \r\n        allowfullscreen></iframe>\r\n    </center>', 1);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `page_list`
--
ALTER TABLE `page_list`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `page_list`
--
ALTER TABLE `page_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
