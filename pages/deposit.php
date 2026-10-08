<?php
requireLogin();
$user_data = getUserData($conn, $_SESSION['user_id']);
?>
<div class="container">
    <h2>Deposit Funds</h2>
    <p>Fund your robotics investment account</p>
    
    <div class="bank-details">
        <h3>Bank Transfer Details</h3>
        <p><strong>Bank:</strong> <?php echo BANK_NAME; ?></p>
        <p><strong>Account:</strong> <?php echo BANK_ACCOUNT; ?></p>
        <p><strong>Account Name:</strong> <?php echo ACCOUNT_NAME; ?></p>
        <p><strong>Minimum:</strong> <?php echo MIN_DEPOSIT; ?> ETB</p>
        <p><strong>Maximum:</strong> <?php echo MAX_DEPOSIT; ?> ETB</p>
    </div>
    
    <form method="POST" action="index.php?action=deposit">
        <div class="form-group">
            <label for="amount">Amount (ETB)</label>
            <input type="number" id="amount" name="amount" min="<?php echo MIN_DEPOSIT; ?>" max="<?php echo MAX_DEPOSIT; ?>" required>
        </div>
        <div class="form-group">
            <label for="payment_method">Payment Method</label>
            <select id="payment_method" name="payment_method">
                <option value="bank_transfer">Bank Transfer</option>
                <option value="telebirr">Telebirr</option>
                <option value="cbe_birr">CBE Birr</option>
            </select>
        </div>
        <div class="form-group">
            <label for="transaction_id">Transaction ID</label>
            <input type="text" id="transaction_id" name="transaction_id" required>
        </div>
        <div class="form-group">
            <label for="sender_name">Sender Name</label>
            <input type="text" id="sender_name" name="sender_name" required>
        </div>
        <div class="form-group">
            <label for="sender_phone">Sender Phone</label>
            <input type="text" id="sender_phone" name="sender_phone" required>
        </div>
        <button type="submit" name="submit_deposit" class="btn">Submit Deposit</button>
    </form>
</div>