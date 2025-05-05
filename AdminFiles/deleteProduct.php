<?php
require_once "ProductManager.php";
$product = new ProductManager();

echo $product->deleteProduct($_POST['id']);

$product->close();
?>
