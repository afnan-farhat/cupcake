<?php
session_start();
?>
<?php
// Get the username from the URL
$fullName = isset($_GET['name']) ? htmlspecialchars($_GET['name']) : 'Guest';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cupcake Store - Home</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css?family=Fredoka" rel="stylesheet">
    <link rel="stylesheet" href="../CSS/mainStyle.css">
</head>
<body>

<!-- Header and Navbar -->

<?php include '../PHP/navbar.php'; ?>


<div class="index-bg">
    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-container">
            <div class="hero-text">
                <h1>Welcome to Our Cupcake Store! 🧁</h1>
                <p>Delicious cupcakes made with love and the freshest ingredients.</p>
                <a href="../php/menu.php" target="_blank" class="btn">Order Now</a>
            </div>
        </div>
    </section>
</div>

</body>
</html>
