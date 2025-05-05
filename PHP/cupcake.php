<?php
$servername = "localhost";
$username = "root";
$password = "Af@2105973";
$dbname = "cupcake_store";

// Create database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// If the order has been submitted via POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get order details (cupcake type and quantity)
    $cake_id = $_POST['cupcake_id'];
    $quantity = $_POST['quantity'];

    // Check if the requested quantity is available in stock
    $sql = "SELECT * FROM cupcakes WHERE id = $cake_id";
    $result = $conn->query($sql);
    $cake = $result->fetch_assoc();

    // If cake exists and there is enough stock
    if ($cake && $cake['quantity'] >= $quantity) {
        // Update the quantity in the database after placing the order
        $new_quantity = $cake['quantity'] - $quantity;
        $update_sql = "UPDATE cupcakes SET quantity = $new_quantity WHERE id = $cake_id";
        if ($conn->query($update_sql) === TRUE) {
            echo "<p>Order placed successfully! You ordered $quantity of " . $cake['name'] . " cupcakes.</p>";
        } else {
            echo "<p>Error updating quantity: " . $conn->error . "</p>";
        }
    } else {
        // If there is not enough stock available
        echo "<p>Sorry, not enough stock available for your order.</p>";
    }
} else {
    // Display available cupcakes from the database
    $sql = "SELECT * FROM cupcakes";
    $result = $conn->query($sql);

    // If there are cupcakes available in the database
    if ($result->num_rows > 0) {
        echo "<h2>Menu</h2>";
        while($row = $result->fetch_assoc()) {
            // Display each available cupcake with correct image name
            echo "<div class='cupcake-item'>";
            echo "<img src='/images/" . strtolower(str_replace(' ', '', $row['name'])) . ".jpg' alt='" . $row['name'] . "'>"; // Display image based on cupcake name
            echo "<h3>" . $row['name'] . "</h3>";
            echo "<p>Price: $" . $row['price'] . "</p>";
            echo "<p>Available Quantity: " . $row['quantity'] . "</p>";
            echo "<form method='POST' action=''>";
            echo "<label for='quantity'>Quantity:</label>";
            echo "<input type='number' name='quantity' min='1' max='" . $row['quantity'] . "' required>";
            echo "<input type='hidden' name='cupcake_id' value='" . $row['id'] . "'>";
            echo "<button type='submit'>Order Now</button>";
            echo "</form>";
            echo "</div>";
        }
    } else {
        // If no cupcakes are available in the database
        echo "<p>No cupcakes available at the moment.</p>";
    }
}

// Close the database connection
$conn->close();
?>