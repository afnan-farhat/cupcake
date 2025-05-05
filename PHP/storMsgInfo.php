<?php
$servername = "localhost";
$username = "root";
$password = "Af@2105973";
$dbname = "cakeDB";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
//Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}



//Create table msg_info
$sql = "CREATE TABLE IF NOT EXISTS msg_info (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    email VARCHAR(100),
    subject VARCHAR(255),
    message TEXT
)";

if ($conn->query($sql) === TRUE) {
    echo "Table created successfully<br>";
} else {
   echo"Error creating table: " . $conn->error;
}

$name = trim($_POST['senderName']);
$email = trim($_POST['senderEmail']);
$subject = trim($_POST['mesSubject']);
$message = trim($_POST['message']);

$errors = [];

// Validation
if (empty($name)) $errors[] = "Name is required.";
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Invalid email format.";
if (empty($subject)) $errors[] = "Subject is required.";
if (strlen($message) < 15) $errors[] = "Message must be at least 15 characters.";

if (!empty($errors)) {
  foreach ($errors as $e) {
    echo "<p>$e</p>";
  }
  exit; // stop execution if there are validation errors
}


//Get data from POST
$name = $_POST['senderName'];
$email = $_POST['senderEmail'];
$subject = $_POST['mesSubject'];
$message = $_POST['message'];



//insert the info(data) and msg
$sql = "INSERT INTO msg_info (name, email, subject, message) 
        VALUES ('$name', '$email', '$subject', '$message')";

if ($conn->query($sql) === TRUE) {
    echo "Data stored successfully.<br>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}



$conn->close();

header("Location: ../HTML/thankyou.html");
exit();


}
?>