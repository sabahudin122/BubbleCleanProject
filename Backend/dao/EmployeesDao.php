<?php
require_once 'BaseDao.php';

class EmployeesDao extends BaseDao {
    public function __construct() {
        parent::__construct("employees");
    }

    public function getByEmail($email) {
        $stmt = $this->connection->prepare("SELECT * FROM employees WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch();
    }
}
?>