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

        

    }
?>