<?php
require_once __DIR__ . '/../dao/EmployeesDao.php';
require_once 'BaseService.php';

class EmployeesService extends BaseService {
    public function __construct() {
        parent::__construct(new EmployeesDao());
    }

    public function getByEmail($email) {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Invalid email format.");
        }
        $result = $this->dao->getByEmail($email);
        if (!$result) {
            throw new Exception("No employee found with the provided email.");
        }
        return $result;
    }
}
?>