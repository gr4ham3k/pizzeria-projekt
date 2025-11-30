<?php
    class Cart{

        private $db;

        public function __construct($db)
        {
            $this->db = $db;
        }

        public function update_cart($cartId,$pizzaId,$dodatekId,$ilosc,$cena)
        {
            $conn = $this->db->getConnection();

            $sql = "SELECT update_cart_item('$cartId','$pizzaId','$dodatekId','$ilosc','$cena')";
            $conn->query($sql);
        
        }

        public function delete_cart($cartId)
        {
            $conn = $this->db->getConnection();

            $sql = "SELECT delete_cart_item('$cartId')";
            $conn->query($sql);
        }

        public function add_to_cart($idPizzy,$idDodatku,$ilosc,$user,$cena)
        {
            
            $conn = $this->db->getConnection();

            $sql = "SELECT add_to_cart('$user','$idPizzy','$idDodatku','$ilosc','$cena')";
            $conn->query($sql);
        }

        public function get_all($id)
        {
            $conn = $this->db->getConnection();
            $stmt = $conn->query("SELECT * FROM get_cart('$id')");
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
            return $result;
        }

    }
?>