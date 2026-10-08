<?php
requireAdmin();
$pending_deposits = $conn->query("SELECT t.*, u.username FROM transactions t 
                                 JOIN users u ON t.user_id = u.id 
                                 WHERE t.type = 'deposit' AND t.status = 'pending'");
$pending_withdrawals = $conn->query("SELECT t.*, u.username FROM transactions t 
                                    JOIN users u ON t.user_id = u.id 
                                    WHERE t.type = 'withdrawal' AND t.status = 'pending'");
?>
<div class="container">
    <h2>Admin Dashboard</h2>
    
    <h3>Pending Deposits</h3>
    <?php if ($pending_deposits && $pending_deposits->num_rows > 0): ?>
        <table class="table">
            <thead>
                <tr>
                    <th>User</th>
                    <th>Amount</th>
                    <th>Reference</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($deposit = $pending_deposits->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $deposit['username']; ?></td>
                    <td><?php echo number_format($deposit['amount'], 2); ?> ETB</td>
                    <td><?php echo $deposit['reference']; ?></td>
                    <td>
                        <a href="index.php?action=admin_approve_deposit&approve_deposit=<?php echo $deposit['id']; ?>" class="btn btn-small">Approve</a>
                        <a href="index.php?action=admin_reject_deposit&reject_deposit=<?php echo $deposit['id']; ?>" class="btn btn-small btn-danger">Reject</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No pending deposits</p>
    <?php endif; ?>
    
    <h3>Pending Withdrawals</h3>
    <?php if ($pending_withdrawals && $pending_withdrawals->num_rows > 0): ?>
        <table class="table">
            <thead>
                <tr>
                    <th>User</th>
                    <th>Amount</th>
                    <th>Reference</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($withdrawal = $pending_withdrawals->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $withdrawal['username']; ?></td>
                    <td><?php echo number_format($withdrawal['amount'], 2); ?> ETB</td>
                    <td><?php echo $withdrawal['reference']; ?></td>
                    <td>
                        <a href="index.php?action=admin_approve_withdrawal&approve_withdrawal=<?php echo $withdrawal['id']; ?>" class="btn btn-small">Approve</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No pending withdrawals</p>
    <?php endif; ?>
</div>