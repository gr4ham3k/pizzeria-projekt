<?php
require_once '../templates/header.php';

// Załaduj klasy
require_once '../classes/Order.php';
require_once '../classes/Auth.php';
require_once '../config/Db.php';

// Obiekty
$db = new Database();
$orders = new Order($db);
$auth = new Auth($db);

// Sprawdź czy użytkownik jest zalogowany
if (!isset($_SESSION['user_email'])) {
    echo "<p>Musisz być zalogowany, aby zobaczyć swoje zamówienia.</p>";
    require_once '../templates/footer.php';
    exit;
}

// Pobierz ID użytkownika
$userData = $auth->get_user_id($_SESSION['user_email']);
$userId = $userData['id_uzytkownika'];

// Pobierz zamówienia użytkownika
$conn = $db->getConnection();
$sql = "SELECT * FROM zamowienia WHERE id_uzytkownika = :uid ORDER BY data_zamowienia DESC";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':uid', $userId, PDO::PARAM_INT);
$stmt->execute();
$userOrders = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<h2>Twoje zamówienia</h2>

<table border="1" cellpadding="10">
    <tr>
        <th>ID zamówienia</th>
        <th>Data</th>
        <th>Status</th>
        <th>Cena całkowita</th>
        <th>Imię</th>
        <th>Nazwisko</th>
        <th>Miasto</th>
        <th>Ulica</th>
        <th>Nr budynku</th>
        <th>Nr mieszkania</th>
        <th>Szczegóły</th>
    </tr>

<?php foreach ($userOrders as $order): ?>
    <tr>
        <td><?= $order['id_zamowienia'] ?></td>
        <td><?= $order['data_zamowienia'] ?></td>
        <td><?= $order['status'] ?></td>
        <td><?= $order['cena_calkowita'] ?> zł</td>
        <td><?= $order['imie'] ?></td>
        <td><?= $order['nazwisko'] ?></td>
        <td><?= $order['miasto'] ?></td>
        <td><?= $order['ulica'] ?></td>
        <td><?= $order['numer_budynku'] ?></td>
        <td><?= $order['numer_mieszkania'] ?: '-' ?></td>

        <td>
            <?php 
                $items = $orders->getOrderItems($order['id_zamowienia']);
                foreach ($items as $item):
            ?>

                <strong><?= $item['produkt'] ?></strong>
                – <?= $item['ilosc'] ?>× (<?= $item['cena'] ?> zł)<br>

                <?php if (!empty($item['dodatek'])): ?>
                    <small>Dodatki: <?= $item['dodatek'] ?></small><br>
                <?php else: ?>
                    <small>Dodatki: brak</small><br>
                <?php endif; ?>

                <hr>

            <?php endforeach; ?>
        </td>
    </tr>
<?php endforeach; ?>

</table>

<?php
require_once '../templates/footer.php';
?>
