<?php
session_start(); // Start session to store user info

// Database connection
$host = "localhost";
$username = "root"; 
$password_db = "Af@2105973";    
$dbname = "cakeDB"; 

// Create connection
$conn = new mysqli($host, $username, $password_db, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$email = $_POST['email'];
$password = $_POST['password'];

// Search for user
$sql = "SELECT * FROM accounts WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();

    if (password_verify($password, $user['password'])) {
        // ✅ Successful login
        $fullName = htmlspecialchars($user['full_name']);
        $_SESSION['role'] = $user['role'];

        // Redirect based on role
        if ($user['role'] === 'admin') {
            header("Location: ../AdminFiles/admin.html");
        
       } else {
        // Redirect with username in URL
        header("Location: ../PHP/index.php?name=" . urlencode($fullName));
        exit();
       }
    } else {
        // ❌ Incorrect password
        header("Location: ../HTML/logIn.html?error=" . urlencode("Incorrect password."));
        exit();
    }
} else {
    // ❌ No user found
    header("Location: ../HTML/logIn.html?error=" . urlencode("No user found with that email."));
    exit();
}

$stmt->close();
$conn->close();


?>
