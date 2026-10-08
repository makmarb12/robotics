<?php
require_once __DIR__ . '/bootstrap.php';

function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

function isAdmin() {
    return isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
}

function requireLogin() {
    if (!isLoggedIn()) {
        redirect('index.php?action=login');
    }
}

function requireAdmin() {
    requireLogin();
    if (!isAdmin()) {
        redirect('index.php?action=home');
    }
}

function logout() {
    session_destroy();
    redirect('index.php');
}
?>