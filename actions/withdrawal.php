<?php
require_once __DIR__ . '/../auth.php';
requireLogin();

$amount = floatval($_POST['amount']);
$method = $_POST['withdrawal_method'];
$account = trim($_POST['account_number']);

$user = $conn->query("SELECT balance FROM users WHERE id = " . $_SESSION['user_id'])->fetch_assoc();

if ($amount <= 100) {
    setFlash('error', "Invalid amount");
} elseif ($amount > $user['balance']) {
    setFlash('error', "Insufficient balance");
} elseif ($amount < 350) {
    setFlash('error', "Minimum withdrawal is 350 ETB");
} else {
    $reference = 'WDR' . time() . rand(100, 999);
    $desc = "Withdrawal request to $method - Account: $account";
    
    $stmt = $conn->prepare("INSERT INTO transactions 
        (user_id, type, amount, status, payment_method, reference, description) 
        VALUES (?, 'withdrawal', ?, 'pending', ?, ?, ?)");
    $stmt->bind_param("idsss", $_SESSION['user_id'], $amount, $method, $reference, $desc);
    
    if ($stmt->execute()) {
        setFlash('success', "Withdrawal request submitted! Reference: $reference");
    } else {
        setFlash('error', "Withdrawal failed: " . $stmt->error);
    }
}
redirect('index.php?action=withdrawal');
?>
