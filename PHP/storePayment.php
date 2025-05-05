<?php
$servername = "localhost";
$username = "root";
$password = "Af@2105973";
$dbname = "cakeDB";



// Connect
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create the table if it doesn't exist
$createTableSQL = "CREATE TABLE IF NOT EXISTS payments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name_on_card VARCHAR(100) NOT NULL,
    card_number VARCHAR(20) NOT NULL,
    month VARCHAR(2) NOT NULL,
    year VARCHAR(4) NOT NULL,
    cvv VARCHAR(3) NOT NULL,
    payment_method VARCHAR(50) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if (!$conn->query($createTableSQL)) {
    die("Error creating table: " . $conn->error);
}

// Get and sanitize input data
$paymentMethod = $_POST['payment-method'];
$name = trim($_POST['name-on-card'] ?? '');
$card = trim($_POST['card-number'] ?? '');
$month = $_POST['month'] ?? '';
$year = $_POST['year'] ?? '';
$cvv = trim($_POST['cvv'] ?? '');
$method = $_POST['payment-method'] ?? '';

$errors = [];

// Validation
if (empty($name)) $errors[] = "Name is required.";
if (!preg_match("/^[a-zA-Z\s]+$/", $name)) $errors[] = "Name must contain only letters and spaces.";
if (!preg_match("/^\d{4}\s\d{4}\s\d{4}\s\d{4}$/", $card)) $errors[] = "Card number must be in the format: 1234 5678 9012 3456.";
if (!preg_match("/^\d{3}$/", $cvv)) $errors[] = "CVV must be 3 digits.";
if (empty($method)) $errors[] = "Payment method is required.";

if (!empty($errors)) {
    foreach ($errors as $error) {
        echo "<p>$error</p>";
    }
    exit;
}

// Insert into the table using prepared statement
$stmt = $conn->prepare("INSERT INTO payments (name_on_card, card_number, month, year, cvv, payment_method) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssss", $name, $card, $month, $year, $cvv, $method);

if ($stmt->execute()) {
    echo "<h3>Payment submitted successfully!</h3>";
} else {
    echo "Error inserting data: " . $stmt->error;
}

$stmt->close();

$conn->close();

header("Location: Paymentconfirm.php");
exit();

?>