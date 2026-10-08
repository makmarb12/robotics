<?php
requireLogin();
$user_data = getUserData($conn, $_SESSION['user_id']);
$transactions = $conn->query("SELECT * FROM transactions WHERE user_id = " . $_SESSION['user_id'] . " ORDER BY created_at DESC LIMIT 10");
?>
<div class="container">
    <h2>My Robotics Profile</h2>
    
    <div class="profile-card">
        <div class="profile-header">
            <div class="profile-avatar">🤖</div>
            <div class="profile-name"><?php echo $user_data['full_name']; ?></div>
            <div class="profile-username">@<?php echo $user_data['username']; ?></div>
        </div>
        
        <div class="profile-stats">
            <div class="stat-item">
                <div class="stat-value"><?php echo $user_data['vip_no']; ?></div>
                <div class="stat-label">VIP ID</div>
            </div>
            <div class="stat-item">
                <div class="stat-value"><?php echo number_format($user_data['balance'], 2); ?> ETB</div>
                <div class="stat-label">Balance</div>
            </div>
            <div class="stat-item">
                <div class="stat-value"><?php echo $user_data['check_in_points']; ?></div>
                <div class="stat-label">Points</div>
            </div>
        </div>
    </div>

    <h3>Recent Transactions</h3>
    <?php if ($transactions && $transactions->num_rows > 0): ?>
        <div class="transaction-list">
            <?php while ($txn = $transactions->fetch_assoc()): ?>
            <div class="transaction-item">
                <div class="txn-type"><?php echo ucfirst($txn['type']); ?></div>
                <div class="txn-amount <?php echo $txn['type'] == 'deposit' ? 'positive' : 'negative'; ?>">
                    <?php echo ($txn['type'] == 'deposit' ? '+' : '-') . number_format($txn['amount'], 2); ?> ETB
                </div>
                <div class="txn-status <?php echo $txn['status']; ?>"><?php echo $txn['status']; ?></div>
                <div class="txn-date"><?php echo date('M d, Y', strtotime($txn['created_at'])); ?></div>
            </div>
            <?php endwhile; ?>
        </div>
    <?php else: ?>
        <p>No transactions yet.</p>
    <?php endif; ?>
</div>