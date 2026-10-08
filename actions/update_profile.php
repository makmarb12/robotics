<?php
require_once __DIR__ . '/../auth.php';
requireLogin();

$full_name = trim($_POST['full_name']);
$email = trim($_POST['email']);
$current = $_POST['current_password'];
$new = $_POST['new_password'];

$user = $conn->query("SELECT password FROM users WHERE id = " . $_SESSION['user_id'])->fetch_assoc();

if (password_verify($current, $user['password'])) {
    if (!empty($new)) {
        if (strlen($new) < 6) {
            setFlash('error', "New password must be at least 6 characters");
        } else {
            $hashed = password_hash($new, PASSWORD_DEFAULT);
            $conn->query("UPDATE users SET full_name = '$full_name', email = '$email', password = '$hashed' WHERE id = " . $_SESSION['user_id']);
            $_SESSION['full_name'] = $full_name;
            setFlash('success', "Profile updated");
        }
    } else {
        $conn->query("UPDATE users SET full_name = '$full_name', email = '$email' WHERE id = " . $_SESSION['user_id']);
        $_SESSION['full_name'] = $full_name;
        setFlash('success', "Profile updated");
    }
} else {
    setFlash('error', "Current password is incorrect");
}
redirect('index.php?action=settings');
?>
