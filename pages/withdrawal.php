<?php
requireLogin();
$user_data = getUserData($conn, $_SESSION['user_id']);
?>
<div class="container">
    <h2>Withdraw Funds</h2>
    <p>Withdraw your robotics investment earnings</p>
    
    <div class="balance-info">
        <h3>Available Balance: <?php echo number_format($user_data['balance'], 2); ?> ETB</h3>
        <p>Minimum withdrawal: 350 ETB</p>
    </div>
    
    <form method="POST" action="index.php?action=withdrawal">
        <div class="form-group">
            <label for="amount">Amount (ETB)</label>
            <input type="number" id="amount" name="amount" min="350" max="<?php echo $user_data['balance']; ?>" required>
        </div>
        <div class="form-group">
            <label for="withdrawal_method">Withdrawal Method</label>
            <select id="withdrawal_method" name="withdrawal_method">
                <option value="bank_transfer">Bank Transfer</option>
                <option value="tele birr">Telebirr</option>
                <option value="cbe_birr">CBE Birr</option>
            </select>
        </div>
        <div class="form-group">
            <label for="account_number">Account Number</label>
            <input type="text" id="account_number" name="account_number" required>
        </div>
        <button type="submit" name="submit_withdrawal" class="btn">Submit Withdrawal</button>
    </form>
</div>