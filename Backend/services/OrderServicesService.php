<?php
require_once __DIR__ . '/../dao/OrderServicesDao.php';
require_once 'BaseService.php';

class OrderServicesService extends BaseService {
    public function __construct() {
        parent::__construct(new OrderServicesDao());
    }

    public function getAllOrderServices($id) {
        if (!is_numeric($id) || $id <= 0) {
            throw new Exception("Invalid ID provided.");
        }
        return $this->dao->getAllOrderServices($id);
    }

    public function createOrderService($data) {
        if (empty($data)) {
            throw new Exception("Order service data cannot be empty.");
        }
        if (!isset($data['order_id']) || !is_numeric($data['order_id']) || $data['order_id'] <= 0) {
            throw new Exception("Invalid order ID provided.");
        }
        if (!isset($data['service_id']) || !is_numeric($data['service_id']) || $data['service_id'] <= 0) {
            throw new Exception("Invalid service ID provided.");
        }
    
        // Validate if order_id exists
        $order = $this->dao->query_unique("SELECT id FROM orders WHERE id = :id", ['id' => $data['order_id']]);
        if (!$order) {
            throw new Exception("Order ID does not exist.");
        }
    
        // Validate if service_id exists
        $service = $this->dao->query_unique("SELECT id FROM services WHERE id = :id", ['id' => $data['service_id']]);
        if (!$service) {
            throw new Exception("Service ID does not exist.");
        }
    
        return $this->dao->insert($data);
    }

    public function updateOrderService($id, $data) {
        if (!is_numeric($id) || $id <= 0) {
            throw new Exception("Invalid order service ID provided.");
        }
        if (empty($data)) {
            throw new Exception("Order service data cannot be empty.");
        }
        return $this->dao->update($id, $data);
    }

    public function deleteOrderService($id) {
        if (!is_numeric($id) || $id <= 0) {
            throw new Exception("Invalid order service ID provided.");
        }
        return $this->dao->delete($id);
    }
}
?>

//