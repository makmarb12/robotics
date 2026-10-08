<?php
requireLogin();
$user_data = getUserData($conn, $_SESSION['user_id']);
$products = $conn->query("SELECT * FROM products WHERE status = 'active' LIMIT 4");
?>
<div class="container">
    <div class="hero-section">
        <h1>🤖 RoboTech AI</h1>
        <p>Invest in the Future of Robotics</p>
        <div class="balance-display">
            <h3>Your Balance: <?php echo number_format($user_data['balance'], 2); ?> ETB</h3>
        </div>
    </div>

    <div class="stats-grid">
        <div class="stat-item">
            <div class="stat-value"><?php echo number_format($user_data['total_income'], 2); ?></div>
            <div class="stat-label">Total Income</div>
        </div>
        <div class="stat-item">
            <div class="stat-value"><?php echo number_format($user_data['day_income'], 2); ?></div>
            <div class="stat-label">Today's Income</div>
        </div>
        <div class="stat-item">
            <div class="stat-value"><?php echo $user_data['check_in_points']; ?></div>
            <div class="stat-label">Points</div>
        </div>
        <div class="stat-item">
            <div class="stat-value"><?php echo $user_data['vip_no']; ?></div>
            <div class="stat-label">VIP ID</div>
        </div>
    </div>

    <h2>Featured Robotics Kits</h2>
    <div class="products-grid">
        <?php while ($product = $products->fetch_assoc()): ?>
        <div class="product-card">
            <img src="<?php echo $product['image_url']; ?>" alt="<?php echo $product['name']; ?>" class="product-image">
            <div class="product-info">
                <h3><?php echo $product['name']; ?></h3>
                <div class="product-price"><?php echo number_format($product['price'], 2); ?> ETB</div>
                <div class="product-income">Daily: <?php echo number_format($product['day_income'], 2); ?> ETB</div>
                <form method="POST" action="index.php?action=purchase_robot">
                    <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                    <button type="submit" name="purchase_robot" class="buy-btn">Invest Now</button>
                </form>
            </div>
        </div>
        <?php endwhile; ?>
    </div>
</div>