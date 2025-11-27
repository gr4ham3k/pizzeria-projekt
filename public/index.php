<?php
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
            require_once 'cart.php';
            break;
        default:
            require_once 'main.php';
    }
?>