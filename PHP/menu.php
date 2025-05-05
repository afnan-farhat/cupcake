<?php
session_start();

// Database connection
$servername = "localhost";
$username = "root";
$password = "Af@2105973";
$dbname = "cakeDB";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch products from the database
$sql = "SELECT * FROM products";
$result = $conn->query($sql);

$products = [];



if ($result && $result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $imagePath = (strpos($row['image'], '../') === 0 || strpos($row['image'], '/') === 0)
            ? $row['image'] // Already full path
            : '../images/' . $row['image']; // Append if just filename

        $products[] = [
            "id" => $row['id'],
            "name" => $row['name'],
            "description" => $row['description'],
            "price" => $row['price'],
            "image" => $imagePath
        ];
    }
}


if (isset($_GET['query']) && !empty(trim($_GET['query']))) {
    $search = strtolower(trim($_GET['query']));
    $products = array_filter($products, function ($product) use ($search) {
        return strpos(strtolower($product['name']), $search) !== false ||
               strpos(strtolower($product['description']), $search) !== false;
    });
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Menu - Cupcake Store</title>
    <link rel="stylesheet" href="../CSS/mainStyle.css">
    <link href="https://fonts.googleapis.com/css?family=Fredoka" rel="stylesheet">
</head>
<body class="background">
<?php include '../PHP/navbar.php'; ?>

<h2 class="page-name">Menu</h2>

    <form method="GET" class="search-form">
    <input type="text" name="query" placeholder="Search cupcakes..." class="search-input" value="<?php echo isset($_GET['query']) ? htmlspecialchars($_GET['query']) : ''; ?>">
    <button type="submit" class="search-button">Search</button>
    </form>



<div class="carousel-container">
    <div class="arrow" onclick="scrollCarousel(-1)">❮</div>
    <div class="product-wrapper" id="productsRow">
        <?php if (!empty($products)): ?>
            <?php foreach ($products as $product): ?>
                <div class="product-box">
                    <a href="product.php?id=<?php echo $product['id']; ?>">
                        <img src="<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" class="cupcake-image">
                        <p class="cupcake-name"><?php echo htmlspecialchars($product['name']); ?></p>
                        <p class="cupcake-price">$<?php echo number_format($product['price'], 2); ?></p>
                    </a>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p style="text-align:center;">No products available. Please check back later!</p>
        <?php endif; ?>
    </div>
    <div class="arrow" onclick="scrollCarousel(1)">❯</div>
</div>

<script>
    const productWrapper = document.getElementById('productsRow');

    function scrollCarousel(direction) {
        const scrollAmount = 300;
        productWrapper.scrollBy({
            left: direction * scrollAmount,
            behavior: 'smooth'
        });
    }

    setInterval(() => {
        scrollCarousel(1);
    }, 5000);
</script>

</body>
</html>
