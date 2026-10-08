<?php
require_once __DIR__ . '/../auth.php';
requireAdmin();

if (isset($_GET['approve_withdrawal'])) {
    $id = intval($_GET['approve_withdrawal']);
    $txn = $conn->query("SELECT * FROM transactions WHERE id = $id")->fetch_assoc();
    if ($txn && $txn['status'] == 'pending') {
        $conn->query("UPDATE users SET balance = balance - {$txn['amount']} WHERE id = {$txn['user_id']}");
        $conn->query("UPDATE transactions SET status = 'completed' WHERE id = $id");
        setFlash('success', "Withdrawal approved");
    }
    redirect('index.php?action=admin');
}
?>
