<?php
$servername = "localhost";
$username = "root";
$password = "Af@2105973";
$dbname = "cakeDB";

// Connect
$conn = new mysqli($servername, $username, $password, $dbname);

// Check
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch contact form records
$sql = "SELECT name, email, subject, message FROM msg_info";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h2>Stored message Info:</h2>";
    while($row = $result->fetch_assoc()) {
        echo "Name: " . $row["name"]. "<br>";
        echo "Email: " . $row["email"]. "<br>";
        echo "Subject: " . $row["subject"]. "<br>";
        echo "Message: " . $row["message"]. "<hr>";
    }
} else {
    echo "No data found.";
}


// Fetch payment records
$sql = "SELECT name_on_card, card_number, month, year, cvv, payment_method, created_at FROM payments";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h2>Stored Payment Info:</h2>";
    while($row = $result->fetch_assoc()) {
        echo "Name on Card: " . $row["name_on_card"] . "<br>";
        echo "Card Number: " . $row["card_number"] . "<br>";
        echo "Month: " . $row["month"] . "<br>";
        echo "Year: " . $row["year"] . "<br>";
        echo "CVV: " . $row["cvv"] . "<br>";
        echo "Payment Method: " . $row["payment_method"] . "<br>";
        echo "Date: " . $row["created_at"] . "<hr>";
    }
} else {
    echo "No payment data found.";
}


$conn->close();
?>