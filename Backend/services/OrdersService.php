<?php
require_once __DIR__ . '/../dao/OrdersDao.php';
require_once 'BaseService.php';

class OrdersService extends BaseService {
    public function __construct() {
        parent::__construct(new OrderDao());
    }

    public function getByUserId($customerId) {
        if (!is_numeric($customerId) || $customerId <= 0) {
            throw new Exception("Invalid customer ID provided.");
        }
        return $this->dao->getByUserId($customerId);
    }

    public function addOrder($data) {
        if (empty($data)) {
            throw new Exception("Order data cannot be empty.");
        }
        if (!isset($data['customer_id']) || !is_numeric($data['customer_id']) || $data['customer_id'] <= 0) {
            throw new Exception("Invalid customer ID provided.");
        }
        $id=$this->dao->add($data);
        return $id>0;
    }

    public function updateOrder($id, $data) {
        if (!is_numeric($id) || $id <= 0) {
            throw new Exception("Invalid order ID provided.");
        }
        if (empty($data)) {
            throw new Exception("Order data cannot be empty.");
        }
        return $this->dao->updateOrder($id, $data);
    }

    public function deleteOrder($id) {
        if (!is_numeric($id) || $id <= 0) {
            throw new Exception("Invalid order ID provided.");
        }
        return $this->dao->deleteOrder($id);
    }
}
?>

//