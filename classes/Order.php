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
            $sql = "UPDATE zamowienia SET status = :status WHERE id_zamowienia = :orderId"; //pgsql
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':status', $status);
            $stmt->bindParam(':orderId', $orderId);
            return $stmt->execute();
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

        public function getOrderItems($orderId)
        {
            $conn = $this->db->getConnection();

            $sql = "
                SELECT 
                    zp.ilosc,
                    zp.cena_pizzy AS cena,
                    p.nazwa AS produkt,
                    COALESCE(d.nazwa, '') AS dodatek
                FROM zamowienie_pizze zp
                LEFT JOIN pizze p ON zp.id_pizzy = p.id_pizzy
                LEFT JOIN dodatki d ON zp.id_dodatku = d.id_dodatku
                WHERE zp.id_zamowienia = :orderId
            "; //pgsql

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':orderId', $orderId, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }




    }
?>