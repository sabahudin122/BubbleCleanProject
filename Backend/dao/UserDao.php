<?php
require_once 'BaseDao.php';

class UserDao extends BaseDao {
    public function __construct() {
        parent::__construct("users");
    }

    public function getByEmail($email) {
        $stmt = $this->connection->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function get_all_users() {
        $query = "SELECT id, name, email, is_admin
                  FROM users";
        return $this->query($query, []);
    }

    public function get_user_by_id($id) {
        return $this->query_unique(
            "SELECT id, name, email, is_admin
             FROM users 
             WHERE id = :id", 
            ["id" => $id]
        );
    }

    public function add_user($user) {
        $user['id'] = $this->insert($user); 
        return $user;
    }

    public function email_exists($email) {
        $result = $this->query_unique(
            "SELECT 1 FROM users WHERE email = :email", 
            ["email" => $email]
        );
        return !empty($result);
    }
}
?>