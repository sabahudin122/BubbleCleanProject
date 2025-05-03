<?php
require_once __DIR__ . '/../dao/ServicesDao.php';
require_once 'BaseService.php';

class ServicesService extends BaseService {
    public function __construct() {
        parent::__construct(new ServicesDao());
    }

    public function addService($data) {
        if (empty($data['service_name']) || empty($data['price'])) {
            throw new Exception("Service name and price are required.");
        }
        if (!is_numeric($data['price']) || $data['price'] <= 0) {
            throw new Exception("Invalid price value.");
        }
        return $this->dao->addServices($data);
    }

    public function updateService($id, $data) {
        if (!is_numeric($id) || $id <= 0) {
            throw new Exception("Invalid ID provided.");
        }
        if (empty($data)) {
            throw new Exception("Data cannot be empty.");
        }
        return $this->dao->updateService($id, $data);
    }

    public function getAllServices($id) {
        if (!is_numeric($id) || $id <= 0) {
            throw new Exception("Invalid ID provided.");
        }
        return $this->dao->getAllServices($id);
    }

    public function deleteService($id) {
        if (!is_numeric($id) || $id <= 0) {
            throw new Exception("Invalid ID provided.");
        }
        return $this->dao->deleteService($id);
    }
}
?>