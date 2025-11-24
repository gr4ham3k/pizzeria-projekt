<?php
require_once '../templates/header.php';

$db = new Database();
$error = '';
$success = '';

// LOGOWANIE
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['mail'])) {
    $mail = $_POST["mail"];
    $password = $_POST["password"];

    try {
        $conn = $db->getConnection();
        $sql = "SELECT * FROM uzytkownicy WHERE email = '$mail' AND haslo = '$password'";
        $stmt = $conn->query($sql);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($user) {
            echo "<div style='color: green; padding: 10px;'>Zalogowano jako: " . htmlspecialchars($user['email']) . "</div>";
        } else {
            $error = "Błędny email lub hasło!";
        }
    } catch (Exception $e) {
        $error = "Błąd połączenia z bazą danych";
    }
}

// REJESTRACJA
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register_mail'])) {
    $mail = $_POST["register_mail"];
    $password = $_POST["register_password"];
    $password_confirm = $_POST["register_password_confirm"];

    try {
        // Sprawdź czy hasła są takie same
        if ($password !== $password_confirm) {
            $error = "Hasła nie są identyczne!";
        } else {
            $conn = $db->getConnection();
            
            // Sprawdź czy użytkownik już istnieje
            $sql = "SELECT * FROM uzytkownicy WHERE email = '$mail'";
            $stmt = $conn->query($sql);
            $existing_user = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($existing_user) {
                $error = "Użytkownik już istnieje!";
            } else {
                // Dodaj nowego użytkownika
                $sql = "INSERT INTO uzytkownicy (email, haslo, rola) VALUES ('$mail', '$password', 'uzytkownik')";
                $conn->query($sql);
                $success = "Rejestracja udana! Możesz się zalogować.";
            }
        }
    } catch (Exception $e) {
        $error = "Błąd rejestracji!";
    }
}
?>

<!DOCTYPE html>
<html>
<body>

    <!-- LOGOWANIE -->
    <div id="logowanie" style="max-width: 400px; margin: 0 auto; padding: 20px; border: 1px solid #ccc;">
        <h2>Logowanie</h2>
        
        <?php if ($error && isset($_POST['mail'])): ?>
            <div style='color: red; padding: 10px;'><?php echo $error; ?></div>
        <?php endif; ?>

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
                <input type="submit" value="Zaloguj" style="padding: 5px 15px;">
                <button type="button" onclick="showRegister()" style="padding: 5px 15px; margin-left: 10px;">Rejestracja</button>
            </div>
        </form>
    </div>

    <!-- REJESTRACJA -->
    <div id="rejestracja" style="max-width: 400px; margin: 0 auto; padding: 20px; border: 1px solid #ccc; display: none;">
        <h2>Rejestracja</h2>
        
        <?php if ($success): ?>
            <div style='color: green; padding: 10px;'><?php echo $success; ?></div>
        <?php endif; ?>
        
        <?php if ($error && isset($_POST['register_mail'])): ?>
            <div style='color: red; padding: 10px;'><?php echo $error; ?></div>
        <?php endif; ?>

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
                <input type="submit" value="Zarejestruj" style="padding: 5px 15px;">
                <button type="button" onclick="showLogin()" style="padding: 5px 15px; margin-left: 10px;">Mam już konto</button>
            </div>
        </form>
    </div>

    <script>
        function showRegister() {
            document.getElementById("logowanie").style.display = "none";
            document.getElementById("rejestracja").style.display = "block";
        }
        
        function showLogin() {
            document.getElementById("rejestracja").style.display = "none";
            document.getElementById("logowanie").style.display = "block";
        }
    </script>

</body>
</html>

<?php
require_once '../templates/footer.php';
?>
