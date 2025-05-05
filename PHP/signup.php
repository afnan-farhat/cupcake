<?php
// Database connection
$servername = "localhost"; // Corrected
$username = "root"; 
$password = "Af@2105973";    
$dbname = "cakeDB"; // Keep it consistent (capital D)

// Connect to MySQL server first without specifying database
    $conn = new mysqli($servername, $username, $password);


// Create a new MySQLi object and check the connection
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Create database if not exists
    $sql = "CREATE DATABASE IF NOT EXISTS `$dbname`";
    if ($conn->query($sql) === TRUE) {
        echo "Database created successfully<br>";
    } else {
        echo "Error creating database: " . $conn->error;
    }

    // Now select the database
    $conn->select_db($dbname);

    // Create table accounts
    $sqlCreateTable = "CREATE TABLE IF NOT EXISTS accounts (
        id INT AUTO_INCREMENT PRIMARY KEY,
        full_name VARCHAR(100) NOT NULL,
        email VARCHAR(100) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL,
        role ENUM('admin', 'user') DEFAULT 'user',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";

    if (!$conn->query($sqlCreateTable)) {
        die("Error creating table: " . $conn->error);
    }


    // Get POST data safely
    $name = $_POST['name'];
    $email = $_POST['email'];
    $passwordHash = password_hash($_POST['password'], PASSWORD_DEFAULT); // Encrypt password
    $role = $_POST['role']; // Get role from the form

    // Insert data
    $sql = "INSERT INTO accounts (full_name, email, password, role) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $name, $email, $passwordHash, $role);

    if ($stmt->execute()) {
        echo "Account created successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close connections
    $stmt->close();
    $conn->close();

    // Redirect
    header("Location: ../HTML/confirmRegistration.html");
    exit();
}
?>
