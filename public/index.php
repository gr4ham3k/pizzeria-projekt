<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }  
    require_once '../classes/Pizze.php';
    require_once '../config/Db.php';

    $page = $_GET['page'] ?? 'main';

    switch($page){
        case 'login':
            require_once 'login.php';
            break;
        case 'register':
            require_once 'register.php';
            break;
        case 'logout':
            require_once 'logout.php';
            break;
        case 'cart':
            if(isset($_SESSION['user_email']))
                require_once 'cart.php';
            else
                require_once 'main.php';
            break;
        case 'cart-delete':
            if(isset($_SESSION['user_email']))
                require_once 'delete-cart.php';
            else
                require_once 'main.php';
            break;
        case 'edit-cart':
            if(isset($_SESSION['user_email']))
                require_once 'edit-cart.php';
            else
                require_once 'main.php';
            break;
        case 'send-order':
            if(isset($_SESSION['user_email']))
                require_once 'send-order.php';
            else
                require_once 'main.php';
            break;
        default:
            require_once 'main.php';
    }
?>