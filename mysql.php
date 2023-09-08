<?php

class DB {
  public function __construct() {
      $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_DATABASE);

      if (!$conn) {
        die ("<h1> DB connection failed </h1>");
      }
      return $this->conn = $conn;
  }
}
?> 