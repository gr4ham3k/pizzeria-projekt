<?php

    require_once '../templates/header.php';
    require_once '../classes/Dodatki.php';
    require_once '../classes/Cart.php';
    require_once '../classes/Auth.php';

    $error_msg = '';
    $success_msg = '';

    $db = new Database();
    $p = new Pizze($db);
    $d = new Dodatki($db);

    $pizze = $p->get_all_pizze_query();
    $dodatki = $d->get_all_dodatki();

    
    if(isset($_POST['id_pizzy']))
    {
        if(isset($_SESSION['user_email']))
        {
            $cart = new Cart($db);
            $user = new Auth($db);

            $userId = $user->get_user_id($_SESSION['user_email']);
        
            $cenaPizzy = ($p->get_single_pizza($_POST['id_pizzy']))[0]['cena'] * $_POST['num'];
            $cenaDodatku = ($d->get_single_dodatek($_POST['dodatki']))[0]['cena_dodatkowa'];
        
            try{
                $cart->add_to_cart($_POST['id_pizzy'],$_POST['dodatki'],$_POST['num'],$userId['id_uzytkownika'],$cenaPizzy+$cenaDodatku);
                $success_msg = "Dodano do koszyka!";
            } catch(PDOException $e){
                $error_msg = "Nie możesz mieć więcej niż 10 pozycji w koszyku";
            }
        } else {
            $error_msg = "Zaloguj się, aby dodać do koszyka";
        }
    }


    if(!empty($error_msg)){
        echo "<div class='msg-div'>
                <div style='background-color:#f8d7da;color:#721c24;padding:10px;margin-bottom:20px;border:1px solid #f5c6cb;border-radius:5px;'>$error_msg</div>
            </div>";
    }
    if(!empty($success_msg)){
        echo "<div class='msg-div'>
            <div style='background-color:#d4edda;color:#155724;padding:10px;margin-bottom:20px;border:1px solid #c3e6cb;border-radius:5px;'>$success_msg</div>
            </div>";
    }

    echo "<div id='pizze'>";
    foreach ($pizze as $item) {
        echo "<div id='pizza-div'>
                <form method='POST'>
                    <img src='..$item[zdjecie_sciezka]'>
                    <p>$item[nazwa] $item[cena] zł 
                    <input type='number' name='num' value='1' max='10' min='1'> 
                    <select name='dodatki'>";
        foreach($dodatki as $dodatek){
            echo "<option value='$dodatek[id_dodatku]'>$dodatek[nazwa] + $dodatek[cena_dodatkowa]zl</option>";
        }
        echo "</select>
            <button type='submit' value='$item[id_pizzy]' id='add-cart' name='id_pizzy'>Dodaj</button>
            </p>
            </form>
            </div><br>";
    }
    echo "</div>";

    require_once '../templates/footer.php';
?>
