<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }   

    require_once '../classes/Auth.php';

    $db = new Database();
    $user = new Auth($db);
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pizzeria</title>
    <link rel="stylesheet" href="../public/assets/css/main-style.css">
</head>
<body>
    <header>
        <div id="header-div">
            <?php
                if(isset($_SESSION['user_email'])){
                    echo "<span>".$_SESSION['user_email']."</span>";
                    echo "<a href='?page=logout' style='color:black'>Wyloguj się</a>";
                }
            ?>
            
            <p>Pizzeria</p>
            <a href="?page=login" style="color:black">Logowanie</a>
            <a href="?page=register" style="color:black">Rejestracja</a>
            <a href="?page=main" style="color:black">Strona glowna</a>
            <?php
                if(isset($_SESSION['user_email']))
                {
                    print("<a href='?page=cart' style='color:black'>Koszyk</a>");
                }

                if(isset($_SESSION['user_email']))
                {
                    $user = $user->get_user_id($_SESSION['user_email']);

                    if($user['rola'] == "uzytkownik")
                    {
                        print("<a href='?page=user-status' style='color:black'>Status</a>");
                    }
                    if($user['rola'] == 'admin')
                    {
                        print("<a href='?page=admin-panel' style='color:black'>Panel admina</a>");
                    }
                    
                }
            ?>
            
        </div>
    </header>
    <main>