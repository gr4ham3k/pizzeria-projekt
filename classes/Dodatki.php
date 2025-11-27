<?php
    class Dodatki{

        private $db;

        public function __construct($db)
        {
            $this->db = $db;
        }

        public function get_all_dodatki()
        {
            $conn = $this->db->getConnection();
            $stmt = $conn->query("SELECT * FROM get_all_dodatki()");
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
            return $result;
        }

        public function get_single_dodatek($id)
        {
            $conn = $this->db->getConnection();
            $stmt = $conn->query("SELECT * FROM dodatki WHERE id_dodatku='$id'"); //to-do jako funkcja w pgsql
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
            return $result;
        }

    }
?>