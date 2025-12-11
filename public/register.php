<?php
    require_once '../templates/header.php';
    require_once '../classes/Auth.php';

    $db = new Database();
    $auth = new Auth($db);
    
?>

 <!-- REJESTRACJA -->
  <div class="register-div">
    <div id="rejestracja">
        <h2>Rejestracja</h2>
        
        <form method="POST">
            <div style="margin: 10px 0;">
                <label>Adres e-mail:</label>
                <input type="text" name="register_mail" required style="margin-left: 10px;">
            </div>

            <div style="margin: 10px 0;">
                <label>Hasło:</label>
                <input type="password" name="register_password" required style="margin-left: 10px;">
            </div>

            <div style="margin: 10px 0;">
                <label>Powtórz hasło:</label>
                <input type="password" name="register_password_confirm" required style="margin-left: 10px;">
            </div>
            
            <div style="margin: 10px 0;">
                <input type="submit" name="register" value="Zarejestruj" style="padding: 5px 15px;">
            </div>
        </form>
        <?php
            if(isset($_POST['register']))
            {
                
                $auth->register();

                if($auth->getError()){
                    echo "<p>".$auth->getError()."</p>";
                }

                if($auth->getSuccessRegister())
                {
                    echo "<p>".$auth->getSuccessRegister()."</p>";
                }
            }
        ?>
    </div>
    </div>

<?php
    require_once '../templates/footer.php';
?>