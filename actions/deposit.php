<?php
require_once __DIR__ . '/../auth.php';
requireLogin();

$amount = floatval($_POST['amount']);
$method = $_POST['payment_method'];
$transaction_id = trim($_POST['transaction_id']);
$sender = trim($_POST['sender_name']);
$phone = trim($_POST['sender_phone']);

$errors = [];
if ($amount < MIN_DEPOSIT) $errors[] = "Minimum deposit is " . MIN_DEPOSIT . " ETB";
if ($amount > MAX_DEPOSIT) $errors[] = "Maximum deposit is " . MAX_DEPOSIT . " ETB";
if (empty($transaction_id)) $errors[] = "Transaction ID required";
if (empty($sender)) $errors[] = "Sender name required";

if (empty($errors)) {
    $reference = 'DEP' . time() . rand(100, 999);
    $stmt = $conn->prepare("INSERT INTO transactions 
        (user_id, type, amount, status, payment_method, transaction_id, sender_name, sender_phone, reference) 
        VALUES (?, 'deposit', ?, 'pending', ?, ?, ?, ?, ?)");
    $stmt->bind_param("idsssss", $_SESSION['user_id'], $amount, $method, $transaction_id, $sender, $phone, $reference);
    
    if ($stmt->execute()) {
        setFlash('success', "Deposit request submitted! Reference: $reference");
    } else {
        setFlash('error', "Failed to submit deposit");
    }
} else {
    $_SESSION['errors'] = $errors;
}
redirect('index.php?action=deposit');
?>
