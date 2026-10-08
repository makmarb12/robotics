<?php
// Start output buffering at the VERY beginning
ob_start();

require_once __DIR__ . '/bootstrap.php';
require_once __DIR__ . '/auth.php';

$action = isset($_GET['action']) ? $_GET['action'] : 'home';

// Handle ALL actions that require redirect BEFORE any output
switch ($action) {
    // Auth Actions
    case 'register':
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {
            include __DIR__ . '/actions/register.php';
            exit();
        }
        break;
    case 'login':
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
            include __DIR__ . '/actions/login.php';
            exit();
        }
        break;
    case 'logout':
        include __DIR__ . '/actions/logout.php';
        exit();
    
    // User Actions
    case 'check_in':
        if (isset($_GET['check_in'])) {
            include __DIR__ . '/actions/check_in.php';
            exit();
        }
        break;
    case 'claim_gift':
        if (isset($_GET['claim_gift'])) {
            include __DIR__ . '/actions/claim_gift.php';
            exit();
        }
        break;
    case 'deposit':
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_deposit'])) {
            include __DIR__ . '/actions/deposit.php';
            exit();
        }
        break;
    case 'withdrawal':
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_withdrawal'])) {
            include __DIR__ . '/actions/withdrawal.php';
            exit();
        }
        break;
    case 'purchase_robot':
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['purchase_robot'])) {
            include __DIR__ . '/actions/purchase.php';
            exit();
        }
        break;
    case 'spin_wheel':
        if (isset($_GET['spin_wheel'])) {
            include __DIR__ . '/actions/spin_wheel.php';
            exit();
        }
        break;
    case 'update_profile':
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_profile'])) {
            include __DIR__ . '/actions/update_profile.php';
            exit();
        }
        break;
    
    // Admin Actions
    case 'admin_approve_deposit':
        if (isset($_GET['approve_deposit'])) {
            include __DIR__ . '/actions/admin_approve_deposit.php';
            exit();
        }
        break;
    case 'admin_reject_deposit':
        if (isset($_GET['reject_deposit'])) {
            include __DIR__ . '/actions/admin_reject_deposit.php';
            exit();
        }
        break;
    case 'admin_approve_withdrawal':
        if (isset($_GET['approve_withdrawal'])) {
            include __DIR__ . '/actions/admin_approve_withdrawal.php';
            exit();
        }
        break;
    
    // Language Change
    case 'language':
        if (isset($_GET['set_lang'])) {
            $_SESSION['lang'] = $_GET['set_lang'];
            setFlash('success', "Language updated!");
            redirect('index.php?action=settings');
            exit();
        }
        break;
}

// If we get here, we're displaying a page - NOW we can include header
include __DIR__ . '/templates/header.php';
include __DIR__ . '/templates/nav.php';

// Show flash messages
displayFlash();

// Load page content
$page_file = __DIR__ . '/pages/' . $action . '.php';
if (file_exists($page_file)) {
    include $page_file;
} else {
    include __DIR__ . '/pages/home.php';
}

include __DIR__ . '/templates/footer.php';

// Flush output buffer
ob_end_flush();
?>