<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        class Database {
        private $pdo;

        public function __construct() {
            require __DIR__ . '/config_local.php';

            $this->pdo = new PDO(
                "pgsql:host=$DB_HOST;port=$DB_PORT;dbname=$DB_NAME",
                $DB_USER,
                $DB_PASS
            );
            
            }
        }
    ?>
</body>
</html>