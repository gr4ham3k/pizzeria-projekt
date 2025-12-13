<?php
    class Order{

        private $db;

        public function __construct($db)
        {
            $this->db = $db;
        }

        public function create_order($userId,$name,$surname,$tel,$city,$road,$building,$apartment,$totalPrice)
        {
            $conn = $this->db->getConnection();

            $sql = "SELECT finalize_order('$userId','$name','$surname','$tel','$city','$road','$building','$apartment','$totalPrice') AS order_id";
            $result = $conn->query($sql);
            $orderId = $result->fetchColumn();
        }

        public function get_all_orders()
        {
            $conn = $this->db->getConnection();
            $sql = "SELECT * FROM zamowienia ORDER BY data_zamowienia DESC"; //pgsql
            $stmt = $conn->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function update_status($orderId, $status)
        {
            $conn = $this->db->getConnection();
            $sql = "SELECT update_order_status(:orderId, :status)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':orderId', $orderId);
            $stmt->bindParam(':status', $status);
            $stmt->execute();

        }

        // public function get_user_orders($userId)
        // {
        //     $conn = $this->db->getConnection();
        //     $sql = "SELECT * FROM zamowienia WHERE id_uzytkownika = :uid ORDER BY data_zamowienia DESC";
        //     $stmt = $conn->prepare($sql);
        //     $stmt->bindParam(':uid', $userId);
        //     $stmt->execute();
        //     return $stmt->fetchAll(PDO::FETCH_ASSOC);
        // }

        public function getOrderItems($order_id)
        {
            $conn = $this->db->getConnection();

            $stmt = $conn->prepare("
                SELECT * FROM get_order_items(:order_id)
            ");
            $stmt->bindParam(':order_id', $order_id, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }





    }
?>