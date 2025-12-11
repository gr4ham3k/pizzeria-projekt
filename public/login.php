<?php
    require_once '../templates/header.php';
    require_once '../classes/Auth.php';

    $db = new Database();
    $auth = new Auth($db);
    
?>
  <!-- LOGOWANIE -->
   <div class="logowanie-div">
    <div id="logowanie">
        <h2>Logowanie</h2>
        
        <form method="POST">
            <div style="margin: 10px 0;">
                <label>Adres e-mail:</label>
                <input type="text" name="mail" required style="margin-left: 10px;">
            </div>

            <div>
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
                $auth->login();

                if($auth->getError()){
                    echo "<p>".$auth->getError()."</p>";
                }else{
                    header('Location: ?page=main');
                }

            }
        ?>
    </div>
    </div>
<?php
    require_once '../templates/footer.php';
?>