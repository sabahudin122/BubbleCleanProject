<?php
require_once 'BaseDao.php';

class ServicesDao extends BaseDao {
    public function __construct() {
        parent::__construct("services");
    }


    public function  addServices ($data) {
        $columns = implode(", ", array_keys($data));
        $placeholders = ":" . implode(", :", array_keys($data));
        $sql = "INSERT INTO services ($columns) VALUES ($placeholders)";
        $stmt = $this->connection->prepare($sql);
        return $stmt->execute($data);
    }
    
    public function updateService ($id, $data) {
        $fields = "";
        foreach ($data as $key => $value) {
            $fields .= "$key = :$key, ";
        }
        $fields = rtrim($fields, ", ");
        $sql = "UPDATE services SET $fields WHERE id = :id";
        $stmt = $this->connection->prepare($sql);
        $data['id'] = $id;
        return $stmt->execute($data);
    }

    public function getAllServices ($id) {
        $stmt = $this->connection->prepare("SELECT * FROM services WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function deleteService ($id) {
        $stmt = $this->connection->prepare("DELETE FROM  orders WHERE id = :id");
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
   
}
?>