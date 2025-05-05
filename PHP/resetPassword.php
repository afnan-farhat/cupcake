<?php
// Database connection
$host = "localhost";
$username = "root"; 
$password = "Af@2105973";
$dbname = "cakeDB"; 

$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get POST values
$email = $_POST['email'];
$newPassword = password_hash($_POST['new_password'], PASSWORD_DEFAULT);  // Hash the new password

// SQL query to update the password for the given email
$sql = "UPDATE accounts SET password = ? WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $newPassword, $email);  // Bind the new password and email

// Execute the query and check if it was successful
if ($stmt->execute()) {
    $msg = "✅ Password has been updated successfully!";
} else {
    $msg = "❌ Failed to update password. Please try again.";
}

// Close the prepared statement and database connection
$stmt->close();
$conn->close();

// Redirect to a result page with the message
header("Location: ../HTML/resetResult.html?msg=" . urlencode($msg));
exit();
?>
