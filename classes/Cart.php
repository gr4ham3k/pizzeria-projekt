<?php
    class Cart{

        private $db;

        public function __construct($db)
        {
            $this->db = $db;
        }

        public function add_to_cart($idPizzy,$idDodatku,$ilosc,$user,$cena)
        {
            
            $conn = $this->db->getConnection();

            $sql = "SELECT add_to_cart('$user','$idPizzy','$idDodatku','$ilosc','$cena')";
            $conn->query($sql);
        }

        public function show_all($id)
        {
            $conn = $this->db->getConnection();
            $stmt = $conn->query("SELECT * FROM koszyk WHERE id_uzytkownika='$id'");
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
            return $result;
        }

    }
?>