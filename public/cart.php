<?php
    require_once '../templates/header.php';
    require_once '../classes/Cart.php';
    require_once '../classes/Dodatki.php';
    require_once '../classes/Auth.php';

    $db = new Database();
    $user = new Auth($db);
    $cart = new Cart($db);
    $pizza = new Pizze($db);
    $dodatki = new Dodatki($db);
    

?>

    <div id="cart-container" style="text-align: center;">
    <h1>Koszyk</h1>
    <?php

        if(isset($_SESSION['error']))
        {
            echo $_SESSION['error'];
            unset( $_SESSION['error']);
        }

        $userId = $user->get_user_id($_SESSION['user_email'])['id_uzytkownika'];
        $items = $cart->get_all($userId);
        $totalPrice = 0;
        $totalPizzaCount = 0;

        foreach($items as $item)
        {
            $p = $pizza->get_single_pizza($item['id_pizzy']);
            $d = $dodatki->get_single_dodatek($item['id_dodatku']);

            $totalPrice += $item['cena_jednostkowa'];
            $totalPizzaCount += $item['ilosc'];
    ?>
        <!--- Koszyk ---> 
        
        <div class="cart-item" style="margin-bottom: 20px;"> 
            <div id="item-<?php echo $item['id_koszyka']; ?>">
                Pizza: <?php echo $item['ilosc'] . " x " . $p[0]['nazwa']; ?>, 
                Dodatek: <?php echo $d[0]['nazwa']; ?>, 
                Razem: <?php echo $item['cena_jednostkowa']; ?>zł
                <button onclick="showEditForm(<?php echo $item['id_koszyka']; ?>)">Edytuj</button>
                <form class="delete-form" method="post" action="?page=cart-delete" style="display:inline;" onsubmit="return confirm('Czy na pewno chcesz usunąć pozycję?');">
                    <button name="delete-btn" value="<?php echo $item['id_koszyka']; ?>">X</button>
                </form>
        </div>
        

        <!--- Formularz edycji --->    
        <form method="post" action="?page=edit-cart" id="form-<?php echo $item['id_koszyka']; ?>" style="display: none; margin-top: 10px;">
            <input type="hidden" name="cart_id" value="<?php echo $item['id_koszyka']; ?>">

            <label>Pizza:</label>
            <select name="pizza_id">
                <?php
                    $all_pizzas = $pizza->get_all_pizze_query();
                    foreach($all_pizzas as $pizz) {
                        $selected = ($pizz['id_pizzy'] == $item['id_pizzy']) ? "selected" : "";
                        echo "<option value='{$pizz['id_pizzy']}' $selected>{$pizz['nazwa']}</option>";
                    }
                ?>
            </select>
            
            <label>Ilość:</label>
            <input type="number" name="ilosc" value="<?php echo $item['ilosc']; ?>" min="1" max="10">

            <label>Dodatek:</label>
            <select name="dodatek_id">
                <?php
                    $all_dodatki = $dodatki->get_all_dodatki();
                    foreach($all_dodatki as $dod) {
                        $selected = ($dod['id_dodatku'] == $item['id_dodatku']) ? "selected" : "";
                        echo "<option value='{$dod['id_dodatku']}' $selected>{$dod['nazwa']}</option>";
                    }
                ?>
            </select>

            <button type="submit">Zapisz</button>
            <button type="button" onclick="hideEditForm(<?php echo $item['id_koszyka']; ?>)">Anuluj</button>
        </form>
        </div>
    <?php
        } // <- koniec glownego foreacha

        $rabat = ($totalPizzaCount >= 2) ? 0.15 : 0;
        $totalPrice = $totalPrice - ($totalPrice*$rabat);

        echo("<p class='cart-total'>Łączna cena: ".round($totalPrice,2)." zł</p>");
        if($rabat>0)
        {
            echo("<p class='cart-total'>Rabat:".($rabat*100)."%</p>");
        }

    ?>

    <!--- Formularz wysylania zamowienia ---> 
    <form method="post" action="?page=send-order" style="margin-bottom: 10px;">
        Imię
        <input type="text" name="name" required><br>
        Nazwisko
        <input type="text" name="surname" required><br>
        Telefon
        <input type="tel" name="tel" required><br>
        Miasto
        <input type="text" name="city" required><br>
        Ulica
        <input type="text" name="road" required><br>
        Numer budynku
        <input type="text" name="building" required><br>
        Numer mieszkania
        <input type="text" name="apartment"><br>
        <input type="number" name="totalPrice" value=<?=$totalPrice?> hidden>
        <button name="send-btn">Zamów</button>
    </form>
</div>

<script>
function showEditForm(id) {
    document.getElementById('item-' + id).style.display = 'none';
    document.getElementById('form-' + id).style.display = 'block';
}

function hideEditForm(id) {
    document.getElementById('form-' + id).style.display = 'none';
    document.getElementById('item-' + id).style.display = 'block';
    
}
</script>

<?php
    require_once '../templates/footer.php';
?>