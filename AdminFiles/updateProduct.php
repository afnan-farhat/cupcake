<?php
require_once "ProductManager.php";
$product = new ProductManager();

echo $product->updateProduct($_POST['id'], $_POST['name'], $_POST['description'], $_POST['price'], $_POST['image']);

$product->close();
?>
