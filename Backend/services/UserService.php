<?php
require_once __DIR__ . '/../dao/UserDao.php';
require_once 'BaseService.php';

class UserService extends BaseService {
    public function __construct() {
        parent::__construct(new UserDao());
    }

    public function getByEmail($email) {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Invalid email format.");
        }
        $result = $this->dao->getByEmail($email);
        if (!$result) {
            throw new Exception("No user found with the provided email.");
        }
        return $result;
    }

    public function emailExists($email) {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Invalid email format.");
        }
        return $this->dao->email_exists($email);
    }

    public function getAllUsers() {
        return $this->dao->get_all_users();
    }

    public function getUserById($id) {
        if (!is_numeric($id) || $id <= 0) {
            throw new Exception("Invalid user ID provided.");
        }
        return $this->dao->get_user_by_id($id);
    }

    public function addUser($user) {
        if (empty($user['name']) || empty($user['email']) || empty($user['password'])) {
            throw new Exception("Name, email, and password are required.");
        }
        if (!filter_var($user['email'], FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Invalid email format.");
        }
        return $this->dao->add_user($user);
    }
}
?>

//