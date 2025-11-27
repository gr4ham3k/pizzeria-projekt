<?php

    require_once '../templates/header.php';
    require_once '../classes/Dodatki.php';
    require_once '../classes/Cart.php';
    require_once '../classes/Auth.php';

    if(isset($_GET['error'])==1)
    {
        print("Zaloguj sie by dodac do koszyka");
    }

    $db = new Database();

    $p = new Pizze($db);
    $d = new Dodatki($db);

    $pizze = $p->get_all_pizze_query();
    $dodatki = $d->get_all_dodatki();

    print("<div id='pizze'>");
    print("<b>Nazwa</b> <b>Cena</b><br>");
    foreach ($pizze as $item) {
        print("<form method=POST><p>$item[nazwa] $item[cena] 
        <input type='number' name='num' value='1' max='10' min='1'> 
        <select name='dodatki'>");
        foreach($dodatki as $dodatek)
        {
            print("<option value='$dodatek[id_dodatku]'>$dodatek[nazwa] + $dodatek[cena_dodatkowa]zl</option>");
        }
        print("</select><button type='submit' value='$item[id_pizzy]' id='add-cart' name='id_pizzy'>Add</button></p></form><br>");
    }
    print("</div>");
    
    if(isset($_POST['id_pizzy']))
    {
        if(isset($_SESSION['user_email']))
        {
            $cart = new Cart($db);
            $user = new Auth($db);

            $userId = $user->get_user_id($_SESSION['user_email']);
            
            $cenaPizzy = ($p->get_single_pizza($_POST['id_pizzy']))[0]['cena'] * $_POST['num'];

            $cenaDodatku = ($d->get_single_dodatek($_POST['dodatki']))[0]['cena_dodatkowa'];
        
            $cart->add_to_cart($_POST['id_pizzy'],$_POST['dodatki'],$_POST['num'],$userId['id_uzytkownika'],$cenaPizzy+$cenaDodatku);
            print("Dodano do koszyka!");
        }
        else{
            header("Location: ?error=1"); 
        }
        
    }

    require_once '../templates/footer.php';

?>
