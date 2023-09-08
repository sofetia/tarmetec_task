<?php

include('mysql.php');

class ProductController {
    public function __construct() {
        $db = new DB;
        $this->conn = $db->conn;
    }
  
    public function addProduct($name, $description, $quantity, $price, $client){
        if($client == ""){
            $client = 'NULL';
        }
        else {
            $client = "'" .  $client . "'";
        }
        $sql = "INSERT INTO products (name, description, quantity, price, client_id) VALUES ('$name', '$description', '$quantity', '$price', $client)";
        $result = $this->conn->query($sql);
        return $result;
    }

    public function getAll($sortBy, $name){
        $sql = "SELECT products.id, products.name, products.description, products.quantity, products.price, clients.name as client_name FROM products LEFT JOIN clients ON products.client_id=clients.id ";
        if ($name != ""){
            $sql = $sql . " WHERE products.name = '$name'";
        }
        if (!empty($sortBy)){
            $sql = $sql . " ORDER BY products.$sortBy";
        }
        $result = $this->conn->query($sql);
        return $result;
    }
    
    public function updateProduct($id, $name, $description, $quantity, $price, $client){
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
        if ($client != ""){
            $sql = $sql . "client_id = '$client' ";
        }
        $sql = rtrim($sql, ',');
        $sql = $sql . " WHERE id = '$id' ";
        $result = $this->conn->query($sql);
        return $result;
    }

    public function getClients(){
        $sql = "SELECT * from clients";
        $result = $this->conn->query($sql);
        return $result;
    }
  }