<?php
        class Database {
            private $pdo;

            public function __construct() {
                require __DIR__ . '/config.php';

                try{
                    $this->pdo = new PDO(
                    "pgsql:host=$DB_HOST;port=$DB_PORT;dbname=$DB_NAME",
                    $DB_USER,
                    $DB_PASS
                    );
                   
                } catch(PDOException $e){
                    die($e->getMessage());
                }
            
            }

            public function getConnection()
            {
                return $this->pdo;
            }
        }

        
    ?>