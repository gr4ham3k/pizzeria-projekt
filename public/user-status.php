<?php
require_once '../templates/header.php';
require_once '../classes/Order.php';
require_once '../classes/Auth.php';
require_once '../config/Db.php';

// Obiekty
$db = new Database();
$orders = new Order($db);
$auth = new Auth($db);

// Pobierz ID użytkownika
$userData = $auth->get_user_id($_SESSION['user_email']);
$userId = $userData['id_uzytkownika'];

// Pobierz zamówienia użytkownika
$conn = $db->getConnection();
$sql = "SELECT * FROM zamowienia WHERE id_uzytkownika = :uid ORDER BY data_zamowienia DESC"; //pgsql
$stmt = $conn->prepare($sql);
$stmt->bindParam(':uid', $userId, PDO::PARAM_INT);
$stmt->execute();
$userOrders = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="orders-container">
<h2 style="text-align: center;">Twoje zamówienia</h2>

<table class="orders-table" border="1" cellpadding="10" style="margin-bottom:60px;">
    <tr>
        <th>Szczegóły</th>
        <th>Data</th>
        <th>Status</th>
        <th>Cena całkowita</th>
        <th>Rabat</th>
        <th>Imię</th>
        <th>Nazwisko</th>
        <th>Miasto</th>
        <th>Ulica</th>
        <th>Nr budynku</th>
        <th>Nr mieszkania</th>
    </tr>

<?php foreach ($userOrders as $order): ?>
    <tr>
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
        <td style="width: 20%;"><?= date('Y-m-d H:i', strtotime($order['data_zamowienia'])) ?></td>
        <td><?= $order['status'] ?></td>
        <td><?= $order['cena_calkowita'] ?> zł</td>
        <td><?= (int)$order['rabat'] ?>%</td>
        <td><?= $order['imie'] ?></td>
        <td><?= $order['nazwisko'] ?></td>
        <td><?= $order['miasto'] ?></td>
        <td><?= $order['ulica'] ?></td>
        <td><?= $order['numer_budynku'] ?></td>
        <td><?= $order['numer_mieszkania'] ?: '-' ?></td>
    </tr>
<?php endforeach; ?>

</table>
</div>
<?php
require_once '../templates/footer.php';
?>
