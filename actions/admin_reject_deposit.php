<?php
require_once __DIR__ . '/../auth.php';
requireAdmin();

if (isset($_GET['reject_deposit'])) {
    $id = intval($_GET['reject_deposit']);
    $conn->query("UPDATE transactions SET status = 'failed' WHERE id = $id");
    setFlash('success', "Deposit rejected");
    redirect('index.php?action=admin');
}
?>
