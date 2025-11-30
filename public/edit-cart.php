<?php
    require_once '../classes/Cart.php';
    require_once '../classes/Dodatki.php';
    require_once '../classes/Pizze.php';

    $db = new Database();
    $cart = new Cart($db);
    $pizza = new Pizze($db);
    $dodatki = new Dodatki($db);

    //wyslanie formularza edycji
    if(isset($_POST['cart_id'], $_POST['pizza_id'], $_POST['dodatek_id'], $_POST['ilosc'])) {
            $cartId = $_POST['cart_id'];
            $pizzaId = $_POST['pizza_id'];
            $dodatekId = $_POST['dodatek_id'];
            $ilosc = $_POST['ilosc'];

            $cena = $pizza->get_single_pizza($_POST['pizza_id'])[0]['cena'] * $_POST['ilosc']
            + $dodatki->get_single_dodatek($_POST['dodatek_id'])[0]['cena_dodatkowa'];

            $cart->update_cart($cartId,$pizzaId,$dodatekId,$ilosc,$cena);

            header("location: ?page=cart");
            exit();
    }
?>