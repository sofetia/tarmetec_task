<?php

include('mysql.php');

class ProductController {
    public function __construct() {
        $db = new DB;
        $this->conn = $db->conn;
    }
  
    public function addProduct($name, $description, $quantity, $price){
        $sql = "INSERT INTO products (name, description, quantity, price) VALUES ('$name', '$description', '$quantity', '$price')";
        $result = $this->conn->query($sql);
        return $result;
    }

    public function getAll($sortBy, $name){
        $sql = "SELECT products.id, products.name, products.description, products.quantity, products.price, clients.name as client_name FROM products INNER JOIN clients ON products.client_id=clients.id ";
        if ($name != ""){
            $sql = $sql . " WHERE name = '$name'";
        }
        if (!empty($sortBy)){
            $sql = $sql . " ORDER BY $sortBy";
        }
        $result = $this->conn->query($sql);
        return $result;
    }
    
    public function updateProduct($id, $name, $description, $quantity, $price){
        $sql = "UPDATE products SET ";
        if ($id == ''){
            return false;
        }
        if ($name != ""){
            $sql = $sql . "name = '$name' ,";
        }
        if ($description != ""){
            $sql = $sql . "description = '$description' ,";
        }
        if ($quantity != ""){
            $sql = $sql . "quantity = '$quantity' ,";
        }
        if ($price != ""){
            $sql = $sql . "price = '$price' ";
        }
        $sql = rtrim($sql, ',');
        $sql = $sql . " WHERE id = '$id' ";
        $result = $this->conn->query($sql);
        return $result;
    }
  }