<?php
requireLogin();
$user_data = getUserData($conn, $_SESSION['user_id']);
$investments = $conn->query("SELECT * FROM investments WHERE user_id = " . $_SESSION['user_id'] . " ORDER BY purchase_date DESC");
?>
<div class="container">
    <h2>Your Robotics Portfolio</h2>
    
    <div class="stats-grid">
        <div class="stat-item">
            <div class="stat-value"><?php echo number_format($user_data['total_income'], 2); ?> ETB</div>
            <div class="stat-label">Total Returns</div>
        </div>
        <div class="stat-item">
            <div class="stat-value"><?php echo number_format($user_data['day_income'], 2); ?> ETB</div>
            <div class="stat-label">Daily Returns</div>
        </div>
        <div class="stat-item">
            <div class="stat-value"><?php echo number_format($user_data['week_income'], 2); ?> ETB</div>
            <div class="stat-label">Weekly Returns</div>
        </div>
        <div class="stat-item">
            <div class="stat-value"><?php echo number_format($user_data['month_income'], 2); ?> ETB</div>
            <div class="stat-label">Monthly Returns</div>
        </div>
    </div>

    <h3>Your Robotics Investments</h3>
    <?php if ($investments && $investments->num_rows > 0): ?>
        <div class="investment-list">
            <?php while ($inv = $investments->fetch_assoc()): ?>
            <div class="investment-item">
                <div class="inv-name"><?php echo $inv['product_name']; ?></div>
                <div class="inv-amount"><?php echo number_format($inv['amount'], 2); ?> ETB</div>
                <div class="inv-profit">Daily: <?php echo number_format($inv['day_income'], 2); ?> ETB</div>
                <div class="inv-status <?php echo $inv['status']; ?>"><?php echo $inv['status']; ?></div>
            </div>
            <?php endwhile; ?>
        </div>
    <?php else: ?>
        <p>No investments yet. Start building your robotics portfolio!</p>
    <?php endif; ?>
</div>