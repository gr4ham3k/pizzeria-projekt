<?php
    require_once '../templates/header.php';
    require_once '../classes/Auth.php';

    $db = new Database();
    $auth = new Auth($db);
    
?>
  <!-- LOGOWANIE -->
    <div id="logowanie" style="max-width: 400px; margin: 0 auto; padding: 20px; border: 1px solid #ccc;">
        <h2>Logowanie</h2>
        
        <form method="POST">
            <div style="margin: 10px 0;">
                <label>Adres e-mail:</label>
                <input type="text" name="mail" required style="margin-left: 10px;">
            </div>

            <div style="margin: 10px 0;">
                <label>Hasło:</label>
                <input type="password" name="password" required style="margin-left: 10px;">
            </div>
            
            <div style="margin: 10px 0;">
                <input type="submit" name="login" value="Zaloguj" style="padding: 5px 15px;">
            </div>
        </form>
        <?php
            if(isset($_POST['login']))
            {
                $auth->login($db);

                if($auth->getError()){
                    echo "<p>".$auth->getError()."</p>";
                }else{
                    header('Location: ?page=main');
                }

            }
        ?>
    </div>
<?php
    require_once '../templates/footer.php';
?>