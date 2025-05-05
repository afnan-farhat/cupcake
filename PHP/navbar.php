<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Save the name from URL to session if it's not already saved
if (isset($_GET['name'])) {
    $_SESSION['username'] = $_GET['name'];
}
?>

<header>
    <nav class="navbar">
        <div class="logo">
            <img src="../images/logo.png" alt="the store logo">
        </div>

        <div class="nav-links">
            <ul>
                <li><a href="../PHP/index.php">Home</a></li>
                <li><a href="../PHP/about.php">About us</a></li>
                <li><a href="../PHP/menu.php">Menu</a></li>
                <li><a href="../PHP/contact.php">Contact</a></li>
                
                <?php
                if (isset($_SESSION['username'])) {
                    echo '<li><a href="#">Hello, ' . htmlspecialchars($_SESSION['username']) . '</a></li>';
                } else {
                    echo '<li><a href="../HTML/logIn.html" class="btn-signup">Log In</a></li>';
                }
                ?>
            </ul>
        </div>
    </nav>
</header>
