<?php
require_once '../templates/header.php';
require_once '../classes/Order.php';
require_once '../config/Db.php';

$db = new Database();
$order = new Order($db);

// ---- ZMIANA STATUSU ----
if (isset($_POST['order_id']) && isset($_POST['status'])) {
    $order->update_status($_POST['order_id'], $_POST['status']);
}

// ---- POBIERANIE LISTY ZAMÓWIEŃ ----
$orders = $order->get_all_orders();
?>

<div class="orders-container">
<h2>Lista zamówień</h2>

<table class="orders-table" border="1" cellpadding="10">
    <thead>
        <tr>
            <th>ID zamówienia</th>
            <th>Imię</th>
            <th>Nazwisko</th>
            <th>Telefon</th>
            <th>Data</th>
            <th>Cena całkowita</th>
            <th>Rabat</th>
            <th>Miasto</th>
            <th>Ulica</th>
            <th>Nr budynku</th>
            <th>Nr mieszkania</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($orders as $o): ?>
            <tr>
                <td><?= $o['id_zamowienia'] ?></td>
                <td><?= $o['imie'] ?></td>
                <td><?= $o['nazwisko'] ?></td>
                <td><?= $o['telefon'] ?></td>
                <td style="width:20%;"><?= date('Y-m-d H:i', strtotime($o['data_zamowienia'])) ?></td>
                <td><?= $o['cena_calkowita'] ?></td>
                <td><?= $o['rabat'] ?></td>
                <td><?= $o['miasto'] ?></td>
                <td><?= $o['ulica'] ?></td>
                <td><?= $o['numer_budynku'] ?></td>
                <td><?= $o['numer_mieszkania'] ?></td>
                <td>
                    <form method="POST" style="display:flex; gap:5px;">
                        <input type="hidden" name="order_id" value="<?= $o['id_zamowienia'] ?>">

                        <select name="status">
                            <option value="złożone"     <?= $o['status']=='złożone' ? 'selected' : '' ?>>złożone</option>
                            <option value="w realizacji" <?= $o['status']=='w realizacji' ? 'selected' : '' ?>>w realizacji</option>
                            <option value="wykonane"    <?= $o['status']=='wykonane' ? 'selected' : '' ?>>wykonane</option>
                        </select>

                        <button type="submit">Zapisz</button>
                    </form>
                </td>

            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</div>
<?php
require_once '../templates/footer.php';
?>
