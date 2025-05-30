<?php
require_once 'BaseDao.php';

class OrderServicesDao extends BaseDao {
    public function __construct() {
        parent::__construct("order_services");
    }

    public function getAllOrderServices($order_id) {
        $stmt = $this->connection->prepare("SELECT * FROM order_services WHERE order_id = :order_id");
        $stmt->bindParam(':order_id', $order_id);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function createOrderService($data) {
        $columns = implode(", ", array_keys($data));
        $placeholders = ":" . implode(", :", array_keys($data));
        $sql = "INSERT INTO order_services ($columns) VALUES ($placeholders)";
        $stmt = $this->connection->prepare($sql);
        return $stmt->execute($data);
    }

    public function updateOrderService($id, $data) {
        $fields = "";
        foreach ($data as $key => $value) {
            $fields .= "$key = :$key, ";
        }
        $fields = rtrim($fields, ", ");
        $sql = "UPDATE order_services SET $fields WHERE id = :id";
        $stmt = $this->connection->prepare($sql);
        $data['id'] = $id;
        return $stmt->execute($data);
    }

    public function deleteOrderService($id) {
        $stmt = $this->connection->prepare("DELETE FROM order_services WHERE id = :id");
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
?>