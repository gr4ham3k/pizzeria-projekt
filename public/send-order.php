<?php
    require_once '../classes/Cart.php';
    require_once '../classes/Auth.php';

    $db = new Database();
    $user = new Auth($db);
    $cart = new Cart($db);

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
            // tworzenie zamowienia
            echo("tworzenie zamowienia");
        }
    }
?>