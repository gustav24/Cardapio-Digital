<?php
class Order {
    private $conn;
    private $table_name = "orders";

    public $id;
    public $customer_name;
    public $customer_email;
    public $customer_phone;
    public $total;
    public $status;
    public $created;
    public $items;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . "
                SET
                    customer_name = :customer_name,
                    customer_email = :customer_email,
                    customer_phone = :customer_phone,
                    total = :total,
                    status = :status";

        $stmt = $this->conn->prepare($query);

        $this->customer_name = htmlspecialchars(strip_tags($this->customer_name));
        $this->customer_email = htmlspecialchars(strip_tags($this->customer_email));
        $this->customer_phone = htmlspecialchars(strip_tags($this->customer_phone));
        $this->total = htmlspecialchars(strip_tags($this->total));
        $this->status = htmlspecialchars(strip_tags($this->status));

        $stmt->bindParam(":customer_name", $this->customer_name);
        $stmt->bindParam(":customer_email", $this->customer_email);
        $stmt->bindParam(":customer_phone", $this->customer_phone);
        $stmt->bindParam(":total", $this->total);
        $stmt->bindParam(":status", $this->status);

        if($stmt->execute()) {
            $this->id = $this->conn->lastInsertId();
            return $this->createOrderItems();
        }
        return false;
    }

    private function createOrderItems() {
        $query = "INSERT INTO order_items
                (order_id, product_id, quantity, price)
                VALUES
                (:order_id, :product_id, :quantity, :price)";

        $stmt = $this->conn->prepare($query);

        foreach($this->items as $item) {
            $stmt->bindParam(":order_id", $this->id);
            $stmt->bindParam(":product_id", $item['product_id']);
            $stmt->bindParam(":quantity", $item['quantity']);
            $stmt->bindParam(":price", $item['price']);

            if(!$stmt->execute()) {
                return false;
            }
        }
        return true;
    }

    public function read() {
        $query = "SELECT o.*, 
                    GROUP_CONCAT(
                        CONCAT(oi.product_id, ':', oi.quantity, ':', oi.price)
                        SEPARATOR '|'
                    ) as items
                FROM " . $this->table_name . " o
                LEFT JOIN order_items oi ON o.id = oi.order_id
                GROUP BY o.id
                ORDER BY o.created DESC";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function updateStatus() {
        $query = "UPDATE " . $this->table_name . "
                SET status = :status
                WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        $this->status = htmlspecialchars(strip_tags($this->status));
        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(":status", $this->status);
        $stmt->bindParam(":id", $this->id);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?> 