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
            $stmt = $conn->prepare("SELECT * FROM get_single_dodatek(:id)");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }


    }
?>