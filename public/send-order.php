<?php
    require_once '../classes/Cart.php';
    require_once '../classes/Order.php';
    require_once '../classes/Auth.php';

    $db = new Database();
    $user = new Auth($db);
    $cart = new Cart($db);
    $order = new Order($db);

    //wysylanie zamowienia
    if(isset($_POST['send-btn']))
    {
        $userId = $user->get_user_id($_SESSION['user_email'])['id_uzytkownika'];
        $items = $cart->get_all($userId);

        if(count($items) === 0)
        {
            $_SESSION['error'] = "Twój koszyk jest pusty!";
            header("Location: ?page=cart");
            exit();
        }
        else{
            $name = $_POST['name'];
            $surname = $_POST['surname'];
            $tel = $_POST['tel'];
            $city = $_POST['city'];
            $road = $_POST['road'];
            $building = $_POST['building'];
            $apartment = $_POST['apartment'];
            $totalPrice = $_POST['totalPrice'];

            $order->create_order($userId,$name,$surname,$tel,$city,$road,$building,$apartment,$totalPrice);
            header("Location: ?page=main");
        }
    }
?>