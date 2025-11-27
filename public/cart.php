<?php
    require_once '../templates/header.php';
    require_once '../classes/Cart.php';
    require_once '../classes/Dodatki.php';
    require_once '../classes/Auth.php';

    $db = new Database();
    $user = new Auth($db);
    $cart = new Cart($db);
    $pizza = new Pizze($db);
    $dodatki = new Dodatki($db);
?>

    <div style="text-align: center;">
        <h1>Koszyk</h1>
        <?php
            $userId = $user->get_user_id($_SESSION['user_email'])['id_uzytkownika'];
            $list = $cart->show_all($userId);
            foreach($list as $item)
            {
                $p = $pizza->get_single_pizza($item['id_pizzy']);
                $d = $dodatki->get_single_dodatek($item['id_dodatku']);
                print("<p>Pizza: {$item['ilosc']} x {$p[0]['nazwa']}, Dodatek: {$d[0]['nazwa']}, Razem: $item[cena_jednostkowa]zł</p>");
            }
        ?>
    </div>

<?php
    require_once '../templates/footer.php';
?>