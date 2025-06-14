<?php
class Order {
    private $conn;
    private $table = 'orders';

    public $id;
    public $customer_name;
    public $customer_email;
    public $customer_phone;
    public $total_amount;
    public $status;
    public $created_at;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = 'INSERT INTO ' . $this->table . '
                SET
                    customer_name = :customer_name,
                    customer_email = :customer_email,
                    customer_phone = :customer_phone,
                    total_amount = :total_amount,
                    status = :status';

        $stmt = $this->conn->prepare($query);

        $this->customer_name = htmlspecialchars(strip_tags($this->customer_name));
        $this->customer_email = htmlspecialchars(strip_tags($this->customer_email));
        $this->customer_phone = htmlspecialchars(strip_tags($this->customer_phone));
        $this->total_amount = htmlspecialchars(strip_tags($this->total_amount));
        $this->status = 'pending';

        $stmt->bindParam(':customer_name', $this->customer_name);
        $stmt->bindParam(':customer_email', $this->customer_email);
        $stmt->bindParam(':customer_phone', $this->customer_phone);
        $stmt->bindParam(':total_amount', $this->total_amount);
        $stmt->bindParam(':status', $this->status);

        if($stmt->execute()) {
            return $this->conn->lastInsertId();
        }
        return false;
    }

    public function addOrderItem($order_id, $product_id, $quantity, $price) {
        $query = 'INSERT INTO order_items
                SET
                    order_id = :order_id,
                    product_id = :product_id,
                    quantity = :quantity,
                    price = :price';

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':order_id', $order_id);
        $stmt->bindParam(':product_id', $product_id);
        $stmt->bindParam(':quantity', $quantity);
        $stmt->bindParam(':price', $price);

        return $stmt->execute();
    }

    public function getOrderDetails($order_id) {
        $query = 'SELECT o.*, oi.product_id, oi.quantity, oi.price, p.name as product_name
                FROM ' . $this->table . ' o
                JOIN order_items oi ON o.id = oi.order_id
                JOIN products p ON oi.product_id = p.id
                WHERE o.id = ?';

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $order_id);
        $stmt->execute();

        return $stmt;
    }
}
?> 