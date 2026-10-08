<?php
require_once __DIR__ . '/../auth.php';
requireLogin();

if (isset($_GET['check_in'])) {
    $today = date('Y-m-d');
    $user_id = $_SESSION['user_id'];
    $check = $conn->query("SELECT id FROM check_ins WHERE user_id = $user_id AND check_in_date = '$today'");
    if ($check->num_rows == 0) {
        $conn->query("INSERT INTO check_ins (user_id, check_in_date) VALUES ($user_id, '$today')");
        $conn->query("UPDATE users SET check_in_points = check_in_points + 1 WHERE id = $user_id");
        setFlash('success', "Check-in successful! +1 Point");
    } else {
        setFlash('error', "Already checked in today");
    }
    redirect('index.php?action=integral');
}
?>
