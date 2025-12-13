<?php
    class Pizze{

        private $db;

        public function __construct(Database $db) {
            $this->db = $db;
        }

        public function get_all_pizze_query()
        {
            $conn = $this->db->getConnection();
            $stmt = $conn->query("SELECT * FROM get_all_pizze()");
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
            return $result;
        }

        public function get_single_pizza($id)
        {
            $conn = $this->db->getConnection();
            $stmt = $conn->prepare("SELECT * FROM get_single_pizza(:id)");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            // UWAGA: fetchAll — żeby $p[0]['nazwa'] działało
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        

    }
?>