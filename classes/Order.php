<?php
    class Order{

        private $db;

        public function __construct($db)
        {
            $this->db = $db;
        }

        public function create_order($userId,$name,$surname,$tel,$city,$road,$building,$apartment)
        {
            $conn = $this->db->getConnection();

            $sql = "SELECT finalize_order('$userId','$name','$surname','$tel','$city','$road','$building','$apartment') AS order_id";
            $result = $conn->query($sql);
            $orderId = $result['order_id'];
        }
    }
?>