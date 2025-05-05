<?php
require_once "ProductManager.php";

if ($_SERVER["REQUEST_METHOD"] === "POST" &&
    isset($_POST['name'], $_POST['description'], $_POST['price'], $_POST['image'])) {

    $product = new ProductManager();
    echo $product->addProduct($_POST['name'], $_POST['description'], $_POST['price'], $_POST['image']);
    $product->close();
} else {
    echo "❌ Invalid input.";
}
?>
