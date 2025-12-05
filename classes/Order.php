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
            $orderId = $result->fetchColumn();
        }

        public function get_all_orders()
        {
            $conn = $this->db->getConnection();
            $sql = "SELECT * FROM zamowienia ORDER BY data_zamowienia DESC";
            $stmt = $conn->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function update_status($orderId, $status)
        {
            $conn = $this->db->getConnection();
            $sql = "UPDATE zamowienia SET status = :status WHERE id_zamowienia = :orderId";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':status', $status);
            $stmt->bindParam(':orderId', $orderId);
            return $stmt->execute();
        }



    }
?>