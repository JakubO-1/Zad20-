<?php
require_once 'db.php';
$message = "";
$msg_class = "";
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql_delete = "DELETE FROM wizyty WHERE id = $id";
    
    if (mysqli_query($conn, $sql_delete)) {
        $message = "Rezerwacja została usunięta.";
        $msg_class = "success";
    } else {
        $message = "Nie udało się usunąć rezerwacji.";
        $msg_class = "error";
    }
}
$sql_select = "SELECT * FROM wizyty ORDER BY data_wizyty ASC, godzina_wizyty ASC";
$result = mysqli_query($conn, $sql_select);
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista wizyt</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <nav>
        <div class="logo">Korepetytor Marek</div>
        <ul>
            <li><a href="index.php">Strona główna</a></li>
            <li><a href="rezerwacja.php">Rezerwacja</a></li>
            <li><a href="lista.php">Lista wizyt</a></li>
        </ul>
    </nav>
</header>
<main style="max-width: 900px;">
    <h2>Lista zaplanowanych wizyt</h2>
    <?php if (!empty($message)): ?>
        <div class="alert <?php echo $msg_class; ?>">
            <?php echo $message; ?>
        </div>
    <?php endif; ?>
    <?php if (mysqli_num_rows($result) > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>Imię i Nazwisko</th>
                    <th>E-mail</th>
                    <th>Data</th>
                    <th>Godzina</th>
                    <th>Usługa</th>
                    <th>Akcja</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td data-label="Imię i Nazwisko"><?php echo htmlspecialchars($row['imie_nazwisko']); ?></td>
                        <td data-label="E-mail"><?php echo htmlspecialchars($row['email']); ?></td>
                        <td data-label="Data"><?php echo htmlspecialchars($row['data_wizyty']); ?></td>
                        <td data-label="Godzina"><?php echo date("H:i", strtotime($row['godzina_wizyty'])); ?></td>
                        <td data-label="Usługa"><?php echo htmlspecialchars($row['usluga']); ?></td>
                        <td data-label="Akcja">
                            <a href="lista.php?action=delete&id=<?php echo $row['id']; ?>" class="btn-delete" onclick="return confirm('Czy na pewno chcesz usunąć tę rezerwację?')">Usuń</a>
                        </td>
                    </tr>
                <?php endofwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p style="color: #e5e5e5;">Brak zarezerwowanych wizyt w systemie.</p>
    <?php endif; ?>
</main>
</body>
</html>