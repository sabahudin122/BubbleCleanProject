<?php
require_once 'BaseDao.php';

class OrderServicesDao extends BaseDao {
    public function __construct() {
        parent::__construct("order_services");
    }

    public function getAllOrderServices ($id) {
        $stmt = $this->connection->prepare("SELECT * FROM order_services WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch();
    }
}
?>