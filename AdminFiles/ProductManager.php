<?php
// Ensure only admins can access product management
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../HTML/login.html");
    exit();
}

class ProductManager {
    private $conn;

    public function __construct($host = "localhost", $user = "root", $pass = "001279", $dbname = "cakeDB") {
        $this->conn = new mysqli($host, $user, $pass, $dbname);
        if ($this->conn->connect_error) {
            die("❌ Connection failed: " . $this->conn->connect_error);
        }
    }

    public function addProduct($name, $description, $price, $image) {
        $stmt = $this->conn->prepare("INSERT INTO products (name, description, price, image) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssds", $name, $description, $price, $image);
        return $stmt->execute() ? "✅ Product added successfully!" : "❌ Error: " . $stmt->error;
    }

    public function updateProduct($id, $name, $description, $price, $image) {
        $stmt = $this->conn->prepare("UPDATE products SET name=?, description=?, price=?, image=? WHERE id=?");
        $stmt->bind_param("ssdsi", $name, $description, $price, $image, $id);
        return $stmt->execute() ? "✅ Product updated successfully!" : "❌ Update error: " . $stmt->error;
    }

    public function deleteProduct($id) {
        $stmt = $this->conn->prepare("DELETE FROM products WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute() ? "✅ Product deleted successfully!" : "❌ Deletion error: " . $stmt->error;
    }

    public function close() {
        $this->conn->close();
    }
}

// 🔽 Example Handler for add/update/delete (make sure form uses POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pm = new ProductManager();

    $action = $_POST['action'] ?? '';
    $name = $_POST['name'] ?? '';
    $desc = $_POST['description'] ?? '';
    $price = $_POST['price'] ?? '';
    $image = $_POST['image'] ?? ''; // Or handle file upload here
    $id = $_POST['id'] ?? null;

    $message = '';

    if ($action === 'add') {
        $message = $pm->addProduct($name, $desc, $price, $image);
    } elseif ($action === 'update' && $id) {
        $message = $pm->updateProduct($id, $name, $desc, $price, $image);
    } elseif ($action === 'delete' && $id) {
        $message = $pm->deleteProduct($id);
    }

    $pm->close();
    echo $message;
}
?>
