<?php
    require_once '../classes/Cart.php';
    
    $db = new Database();
    $cart = new Cart($db);

    //wyslanie formularza usuwania
    if(isset($_POST['delete-btn']))
    {
        $cartId = $_POST['delete-btn'];
        $cart->delete_cart($cartId);
        header("location: ?page=cart");
    }
?>