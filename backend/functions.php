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

        public function getBestSeller() {
            $query = "SELECT * FROM items ORDER BY items_sold DESC LIMIT 1";
            $result = mysqli_query($this->conn, $query);
            $bestSellers = [];

            if ($result) {
                while ($item = mysqli_fetch_assoc($result)) {
                    $bestSellers[] = $item;
                }
            }

            return $bestSellers;
        }

        public function getCategories() {
            $query = "SELECT DISTINCT category FROM items";
            $result = mysqli_query($this->conn, $query);
            $categories = [];

            if ($result) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $categories[] = $row['category']; // <-- only the string
                }
            }

            return $categories;
        }

        public function getItemById($id) {
            $query = "SELECT item_id, name, description, price, image, category, status, items_sold, created_at, edited_at 
                    FROM items WHERE item_id = ?";
            
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("i", $id);
            $stmt->execute();

            $result = $stmt->get_result();
            return $result->fetch_assoc();  // returns one row as array
        }

        // CREATE
        public function create($name, $description, $price, $image, $category, $status) {
            $query = "INSERT INTO items (name, description, price, image, category, status) 
                    VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("ssdsss", $name, $description, $price, $image, $category, $status);
            return $stmt->execute();
        }

        // UPDATE
        public function update($id, $name, $description, $price, $image, $category, $status) {
            $query = "UPDATE items 
                    SET name=?, description=?, price=?, image=?, category=?, status=?, edited_at=NOW() 
                    WHERE item_id=?";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("ssdsssi", $name, $description, $price, $image, $category, $status, $id);
            return $stmt->execute();
        }

        // DELETE
        public function delete($id) {
            $query = "DELETE FROM items WHERE item_id=?";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("i", $id);
            return $stmt->execute();
        }

    }

?> 