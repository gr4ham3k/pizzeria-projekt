<?php
    require_once '../classes/Pizze.php';
    require_once '../config/Db.php';

    $page = $_GET['page'] ?? 'main';

    switch($page){
        case 'main':
            require_once 'main.php';
            break;
        default:
            require_once 'main.php';
    }
?>