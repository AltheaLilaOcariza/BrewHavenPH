<?php
    require 'database.php';

    class Item {
        private $conn;

        public function __construct() {
            $database = new Database();
            $this->conn = $database->getConnection();
        }

        public function getAllItems() {
            $query = "SELECT * FROM items";
            $result = mysqli_query($this->conn, $query);
            $items = [];

            if ($result) {
                while ($item = mysqli_fetch_assoc($result)) {
                    $items[] = $item;
                }
            }

            return $items;
        }

        public function getAllSnacks() {
            $query = "SELECT * FROM items WHERE category='Snack'";
            $result = mysqli_query($this->conn, $query);
            $snacks = [];

            if ($result) {
                while ($snack = mysqli_fetch_assoc($result)) {
                    $snacks[] = $snack;
                }
            }

            return $snacks;
        }

        public function getAllDrinks() {
            $query = "SELECT * FROM items WHERE category='Drink'";
            $result = mysqli_query($this->conn, $query);
            $drinks = [];

            if ($result) {
                while ($drink = mysqli_fetch_assoc($result)) {
                    $drinks[] = $drink;
                }
            }

            return $drinks;
        }
    }

?> 