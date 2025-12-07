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
    <link rel="stylesheet" href="../public/assets/css/status.css">
    <link rel="stylesheet" href="../public/assets/css/cart.css">
</head>
<body>
    <header>
    <div id="header-div">
        <div id="header-div-inner">
            <p>Pizzeria</p>
            <div class="user-section">
                <?php if(isset($_SESSION['user_email'])): ?>
                    <span><?php echo $_SESSION['user_email']; ?></span>
                    <a href='?page=logout'>Wyloguj się</a>
                    <a href='?page=cart'>Koszyk</a>
                    <?php
                        $userData = $user->get_user_id($_SESSION['user_email']);
                        if($userData['rola'] == 'uzytkownik') {
                            echo "<a href='?page=user-status'>Status</a>";
                        }
                        if($userData['rola'] == 'admin') {
                            echo "<a href='?page=admin-panel'>Panel admina</a>";
                        }
                    ?>
                <?php else: ?>
                    <a href='?page=login'>Logowanie</a>
                    <a href='?page=register'>Rejestracja</a>
                <?php endif; ?>
                <a href='?page=main'>Strona główna</a>
            </div>
        </div>
    </div>
    </header>


    <main>