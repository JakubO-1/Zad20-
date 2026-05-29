<?php
require_once 'db.php';
$message = "";
$msg_class = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $imie_nazwisko = trim($_POST['imie_nazwisko']);
    $email = trim($_POST['email']);
    $data_wizyty = $_POST['data_wizyty'];
    $godzina_wizyty = $_POST['godzina_wizyty'];
    $usluga = $_POST['usluga'];

    if (empty($imie_nazwisko) || empty($email) || empty($data_wizyty) || empty($godzina_wizyty) || empty($usluga)) {
        $message = "Wszystkie pola są wymagane.";
        $msg_class = "error";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "Podany adres e-mail jest nieprawidłowy.";
        $msg_class = "error";
    } else {
        $imie_nazwisko = mysqli_real_escape_string($conn, $imie_nazwisko);
        $email = mysqli_real_escape_string($conn, $email);
        $data_wizyty = mysqli_real_escape_string($conn, $data_wizyty);
        $godzina_wizyty = mysqli_real_escape_string($conn, $godzina_wizyty);
        $usluga = mysqli_real_escape_string($conn, $usluga);

        $sql = "INSERT INTO wizyty (imie_nazwisko, email, data_wizyty, godzina_wizyty, usluga) 
                VALUES ('$imie_nazwisko', '$email', '$data_wizyty', '$godzina_wizyty', '$usluga')";

        if (mysqli_query($conn, $sql)) {
            $message = "Rezerwacja została pomyślnie dodana!";
            $msg_class = "success";
        } else {
            $message = "Błąd podczas zapisu: " . mysqli_error($conn);
            $msg_class = "error";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zarezerwuj wizytę</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
    <nav>
        <div class="logo">Korepetytor EduPlus</div>
        <ul>
            <li><a href="index.php">Strona główna</a></li>
            <li><a href="rezerwacja.php">Rezerwacja</a></li>
            <li><a href="lista.php">Lista wizyt</a></li>
        </ul>
    </nav>
</header>
<main>
    <h2>Zarezerwuj termin korepetycji</h2>
    <?php if (!empty($message)): ?>
        <div class="alert <?php echo $msg_class; ?>">
            <?php echo $message; ?>
        </div>
    <?php endif; ?>
    <form action="rezerwacja.php" method="POST">
        <div class="form-group">
            <label for="imie_nazwisko">Imię i nazwisko:</label>
            <input type="text" id="imie_nazwisko" name="imie_nazwisko" required>
        </div>
        <div class="form-group">
            <label for="email">Adres e-mail:</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="data_wizyty">Data wizyty:</label>
            <input type="date" id="data_wizyty" name="data_wizyty" required>
        </div>
        <div class="form-group">
            <label for="godzina_wizyty">Godzina wizyty:</label>
            <input type="time" id="godzina_wizyty" name="godzina_wizyty" required>
        </div>
        <div class="form-group">
            <label for="usluga">Rodzaj usługi:</label>
            <select id="usluga" name="usluga" required>
                <option value="">-- Wybierz przedmiot --</option>
                <option value="Matematyka">Matematyka</option>
                <option value="Fizyka">Fizyka</option>
                <option value="Język angielski">Język angielski</option>
                <option value="Informatyka">Informatyka</option>
            </select>
        </div>
        <button type="submit">Zarezerwuj</button>
    </form>
</main>

</body>
</html>