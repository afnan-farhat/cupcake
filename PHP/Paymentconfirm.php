<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8" />
  <title>Payment Confirmation</title>
  <link rel="stylesheet" href="../CSS/mainStyle.css">
</head>
<body class="payment-body">

<div class="payment-box">
  <h2>Payment Successfully Processed! 💳</h2>

  <?php
  // Database connection
  $conn = new mysqli("localhost", "root", "Af@2105973", "cakeDB"); // change credentials
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }

  // Fetch the latest product details (name, price, and created_at) from the products table
  $sql = "SELECT name, price, created_at FROM products ORDER BY id DESC LIMIT 1"; 
  $result = $conn->query($sql);

  if ($result && $result->num_rows > 0) {
      $row = $result->fetch_assoc();
      echo "<div class='summary'>";
      echo "<div class='info-line'><strong>Product Name:</strong> " . htmlspecialchars($row['name']) . "</div>";
      echo "<div class='info-line'><strong>Price:</strong> $" . number_format($row['price'], 2) . "</div>";
      echo "<div class='info-line'><strong>Date of Payment:</strong> " . date("F j, Y", strtotime($row['created_at'])) . "</div>";
      echo "</div>";
  } else {
      echo "<p>No recent product found.</p>";
  }

  $conn->close();
  ?>

  <p>We will review your ad and notify you within 24 hours. 📧</p>

  <a href="../PHP/index.php" class="btn-home">Back to Website</a>
</div>

</body>
</html>
