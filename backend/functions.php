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

        public function getTopBestSeller($num_of_items) {
            $query = "SELECT * FROM items ORDER BY items_sold DESC LIMIT $num_of_items";
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

        // UPDATE ITEMS SOLD
        public function updateItemsSold($id, $quantity) {
            $query = "UPDATE items SET items_sold = items_sold + ? WHERE item_id = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("ii", $quantity, $id);
            return $stmt->execute();
        }


    }

    class OrderDAO {
        private $conn;

        public function __construct() {
            $database = new Database();
            $this->conn = $database->getConnection();
        }

        // CREATE ORDER
        public function createOrder($totalAmount, $status, $items = []) {
            // Insert into orders
            $stmt = $this->conn->prepare("INSERT INTO orders (total_amount, status) VALUES (?, ?)");
            $stmt->bind_param("ds", $totalAmount, $status);
            $stmt->execute();
            $orderId = $stmt->insert_id;
            $stmt->close();

            // Insert order items and update items_sold
            foreach ($items as $item) {
                $subtotal = $item['quantity'] * $item['price_each'];

                // Insert into order_items
                $stmt = $this->conn->prepare(
                    "INSERT INTO order_items (order_id, item_id, quantity, price_each, subtotal) VALUES (?, ?, ?, ?, ?)"
                );
                $stmt->bind_param(
                    "iiidd",
                    $orderId,
                    $item['item_id'],
                    $item['quantity'],
                    $item['price_each'],
                    $subtotal
                );
                $stmt->execute();
                $stmt->close();

                // Update items_sold in items table
                $stmtUpdate = $this->conn->prepare(
                    "UPDATE items SET items_sold = items_sold + ? WHERE item_id = ?"
                );
                $stmtUpdate->bind_param("ii", $item['quantity'], $item['item_id']);
                $stmtUpdate->execute();
                $stmtUpdate->close();
            }

            return $orderId;
        }

        // READ ALL ORDERS
        public function getAllOrders() {
            $orders = [];
            $result = $this->conn->query("SELECT * FROM orders ORDER BY created_at DESC");
            while ($row = $result->fetch_assoc()) {
                $orders[] = $row;
            }
            return $orders;
        }

        // READ ORDER BY ID (with items)
        public function getOrderById($orderId) {
            $stmt = $this->conn->prepare("SELECT * FROM orders WHERE order_id = ?");
            $stmt->bind_param("i", $orderId);
            $stmt->execute();
            $order = $stmt->get_result()->fetch_assoc();
            $stmt->close();

            if ($order) {
                $stmt = $this->conn->prepare("SELECT * FROM order_items WHERE order_id = ?");
                $stmt->bind_param("i", $orderId);
                $stmt->execute();
                $items = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
                $stmt->close();
                $order['items'] = $items;
            }

            return $order;
        }

        // UPDATE ORDER STATUS
        public function updateOrderStatus($orderId, $status) {
            $stmt = $this->conn->prepare("UPDATE orders SET status = ? WHERE order_id = ?");
            $stmt->bind_param("si", $status, $orderId);
            $stmt->execute();
            $stmt->close();
            return true;
        }

        // DELETE ORDER
        public function deleteOrder($orderId) {
            $stmt = $this->conn->prepare("DELETE FROM orders WHERE order_id = ?");
            $stmt->bind_param("i", $orderId);
            $stmt->execute();
            $stmt->close();
            return true;
        }

        // UPDATE ORDER ITEM QUANTITY
        public function updateOrderItem($orderItemId, $quantity) {
            // Get price_each first
            $stmt = $this->conn->prepare("SELECT price_each FROM order_items WHERE order_item_id = ?");
            $stmt->bind_param("i", $orderItemId);
            $stmt->execute();
            $price = $stmt->get_result()->fetch_assoc()['price_each'];
            $stmt->close();

            $subtotal = $price * $quantity;
            $stmt = $this->conn->prepare("UPDATE order_items SET quantity = ?, subtotal = ? WHERE order_item_id = ?");
            $stmt->bind_param("idi", $quantity, $subtotal, $orderItemId);
            $stmt->execute();
            $stmt->close();
            return true;
        }

        // GET LAST ORDER ID
        public function getLastOrderId() {
            $result = $this->conn->query("SELECT order_id FROM orders ORDER BY order_id DESC LIMIT 1");
            if ($row = $result->fetch_assoc()) {
                return $row['order_id'];
            }
            return 0; // no orders yet
        }

        public function getMonthlySales() {
            $sales = [];
            $result = $this->conn->query("SELECT 
                        DATE_FORMAT(created_at, '%Y-%m') AS month,
                        SUM(total_amount) AS total_sales
                    FROM orders
                    WHERE status = 'completed'
                    GROUP BY DATE_FORMAT(created_at, '%Y-%m')
                    ORDER BY month ASC");
            while ($row = $result->fetch_assoc()) {
                $sales[] = $row;
            }
            return $sales;
        }

        public function getTotalSales() {
            $total = 0;

            $result = $this->conn->query("
                SELECT SUM(total_amount) AS total_sales
                FROM orders
                WHERE status = 'completed'
            ");

            if ($result) {
                $row = $result->fetch_assoc();
                $total = $row['total_sales'] ?? 0;
            }

            return $total;
        }

        public function getAverageOrderValue() {
            $avg = 0;

            $result = $this->conn->query("
                SELECT AVG(total_amount) AS avg_order
                FROM orders
                WHERE status = 'completed'
            ");

            if ($result) {
                $row = $result->fetch_assoc();
                $avg = $row['avg_order'] ?? 0;
            }

            return number_format((float)$avg, 2, '.', '');
        }

        public function getCompletedOrdersCount() {
            $result = $this->conn->query("SELECT COUNT(*) as total FROM orders WHERE status = 'completed'");
            $row = $result->fetch_assoc();
            return $row['total'] ?? 0;
        }
    }

?> 