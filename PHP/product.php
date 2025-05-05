<?php
session_start();

// Database connection
$servername = "localhost";
$username = "root";
$password = "Af@2105973";
$dbname = "cakeDB"; // قاعدة بيانات المنتجات

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


//Create the table of products information
// Create database if it doesn't exist
$sql_create_db = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sql_create_db) === TRUE) {
    // Proceed with the table creation
} else {
    die("Error creating database: " . $conn->error);
}

// Select the database
$conn->select_db($dbname);

// Create products table if it doesn't exist
$sqlCreateTable = "CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    image VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if (!$conn->query($sqlCreateTable)) {
    die("Error creating table: " . $conn->error);
}

// Check if the table is empty
$result = $conn->query("SELECT COUNT(*) as count FROM products");
$row = $result->fetch_assoc();

if ($row['count'] == 0) {
    // Insert products into the products table
    $sqlInsertData = "INSERT INTO products (name, description, price, image) VALUES
    ('Blue Cream Chocolate', 'Delicious chocolate cupcake topped with blue cream frosting.', 6.00, '../images/choco blue.png'),
    ('Cherry with Cream', 'Moist cupcake with sweet cherry and rich cream topping.', 5.00, '../images/cupcack with cherry.jpg'),
    ('Red Velvet with Cream', 'Classic red velvet cupcake with smooth cream cheese frosting.', 7.00, '../images/redvilivatCream.jpg'),
    ('Strawberry Cream', 'Fresh strawberry cupcake with a creamy topping.', 8.00, '../images/strubarrycream.jpg'),
    ('Strawberry Pieces', 'Strawberry cupcake with real strawberry pieces.', 10.00, '../images/5.png'),
    ('Strawberry Swirl', 'A fluffy vanilla cupcake filled with fresh strawberry jam and swirled frosting.', 7.00, '../images/StrawberryCupcake.png'),
    ('Caramel Crunch', 'Moist chocolate cupcake topped with creamy caramel and crunchy toffee bits.', 8.00, '../images/CaramelCrunchCupcake.png'),
    ('Lemon Zest', 'A light lemon cupcake bursting with citrus flavor and topped with lemon buttercream.', 6.00, '../images/LemonZestCupcak.png'),
    ('Red Velvet Charm', 'Classic red velvet cupcake with smooth cream cheese frosting and a hint of cocoa.', 9.00, '../images/RedVelvetCharmCupcake.png')";
    
if ($conn->query($sqlInsertData) === TRUE) {
//inserted sucssfully
}

}


// Get the product from the database based on the index passed via URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $productId = $_GET['id'];

     // Retrieve product details from the database
    $sql = "SELECT * FROM products WHERE id = $productId";


    // Retrieve product details from the database
   
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $product = $result->fetch_assoc();
    } else {
        // If no product found, redirect back to the menu with a message
        echo "<p>No product found with the provided ID.</p>";
        exit;  // Stop further execution
    }
} else {
    // If index is incorrect or not set, redirect back to the product page
    echo "<p>Invalid product ID.</p>";
    exit;  // Stop further execution
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title><?php echo $product['name']; ?> - Cupcake Store</title>
    <link rel="stylesheet" href="../CSS/mainStyle.css">
    <link rel="stylesheet" href="../CSS/style.css">
    <link href="https://fonts.googleapis.com/css?family=Fredoka" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>

<body class="background">

    <?php include '../PHP/navbar.php'; ?>

    <div class="row">
        <div class="column">
            <img class="product-image" src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">
        </div>

        <div class="column">
            <div class="description">
                <h3><?php echo $product['name']; ?></h3>
                <p><?php echo $product['description']; ?></p>
                <br>

                <form action="..\HTML\payment-form.html" method="get">
                    <div class="dropdown">
                        <button type="button" class="dropbtn" id="selectedQuantity">Choose quantity</button>
                        <div class="dropdown-content">
                            <a href="#" onclick="selectQuantity(1)">1</a>
                            <a href="#" onclick="selectQuantity(2)">2</a>
                            <a href="#" onclick="selectQuantity(3)">3</a>
                            <a href="#" onclick="selectQuantity(4)">4</a>
                        </div>
                    </div>

                    <!-- Hidden input to store the selected quantity -->
                    <input type="hidden" name="quantity" id="quantityInput" required>

                    <div class="row">
                        <div class="column">
                            <h4>Price</h4>
                        </div>
                        <div class="column">
                            <h3 class="price">$<?php echo number_format($product['price'], 2); ?></h3>
                        </div>
                    </div>

                    <div class="row">
                        <div class="column">
                            <a href="..\PHP\menu.php">
                                <button type="button" value="Cancel" class="button-cancel">Cancel</button>
                            </a>
                        </div>
                        <div class="column">
                            <a href="..\HTML\payment-form.html">
                                <button type="submit" class="button-next">Next</button>
                            </a>
                        </div>
                    </div>
                </form>

                <br><br><br>
            </div>
        </div>
    </div>

    <script>
        function selectQuantity(qty) {
            document.getElementById('selectedQuantity').innerText = qty + " piece(s)";
            document.getElementById('quantityInput').value = qty;
        }
    </script>

</body>

</html>