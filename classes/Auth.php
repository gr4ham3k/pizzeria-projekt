<?php
class Auth
{
    private $db;
    private $error;
    private $successRegister;
    private $logged;

    public function __construct($db)
    {
        $this->logged = 0;
        $this->error = '';
        $this->db = $db;
    }

    public function register()
    {
        // REJESTRACJA
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register_mail'])) {
            $mail = $_POST["register_mail"];
            $password = $_POST["register_password"];
            $password_confirm = $_POST["register_password_confirm"];

            try {
                // Sprawdź czy hasła są takie same
                if ($password !== $password_confirm) {
                    $this->error = "Hasla sie roznia!";
                } else {
                    $conn = $this->db->getConnection();

                    // Sprawdź czy użytkownik już istnieje
                    $sql = "SELECT * FROM get_user_by_email('$mail')";
                    $stmt = $conn->query($sql);
                    $existing_user = $stmt->fetch(PDO::FETCH_ASSOC);

                    if ($existing_user) {
                        $this->error = "Uzytkownik juz istnieje!";
                    } else {
                        // Dodaj nowego użytkownika
                        $sql = "SELECT add_user('$mail','$password')";
                        $conn->query($sql);
                        $this->successRegister = "Udalo sie zarejestrowac!";
                    }
                }
            } catch (Exception $e) {
                $this->error = "Blad rejestracji!";
            }
        }
    }

    public function login()
    {
        // LOGOWANIE
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['mail'])) {
            $mail = $_POST["mail"];
            $password = $_POST["password"];

            try {
                $conn = $this->db->getConnection();
                $sql = "SELECT * FROM login('$mail','$password')";
                $stmt = $conn->query($sql);
                $user = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($user) {
                    $_SESSION['user_email'] = $user['email'];
                    $this->logged = 1;
                } else {
                    $this->error = "Zly login lub haslo";
                }
            } catch (Exception $e) {
                $this->error = "Nie udalo sie zalogowac";
            }
        }
    }

    public function isLogged(){
        return $this->logged;
    }

    public function getError()
    {
        return $this->error;
    }

    public function getSuccessRegister()
    {
        return $this->successRegister;
    }

    public function get_user_id($email)
    {
        $conn = $this->db->getConnection();
        $sql = "SELECT * FROM get_user_by_email('$email')";
        $stmt = $conn->query($sql);
        $userId = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $userId;
    }

}
?>