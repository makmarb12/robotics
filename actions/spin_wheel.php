<?php
require_once __DIR__ . '/../auth.php';
requireLogin();

if (isset($_GET['spin_wheel'])) {
    $user_id = $_SESSION['user_id'];
    $user = $conn->query("SELECT check_in_points FROM users WHERE id = $user_id")->fetch_assoc();
    if ($user['check_in_points'] >= 10) {
        $prizes = [5, 10, 20, 50, 100, 0];
        $prize = $prizes[array_rand($prizes)];
        $conn->query("UPDATE users SET check_in_points = check_in_points - 10, balance = balance + $prize WHERE id = $user_id");
        $conn->query("INSERT INTO transactions (user_id, type, amount, status, reference, description) 
                     VALUES ($user_id, 'bonus', $prize, 'completed', 'WHEEL' . UNIX_TIMESTAMP(), 'Wheel of fortune prize')");
        setFlash('success', "You won $prize ETB!");
    } else {
        setFlash('error', "You need at least 10 points to spin");
    }
    redirect('index.php?action=wheel');
}
?>
