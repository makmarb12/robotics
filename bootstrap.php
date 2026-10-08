<?php
// No whitespace before this line!
session_start();

require_once __DIR__ . '/config.php';
require_once __DIR__ . '/db.php';

// Initialize database
$conn = initDatabase();

// Load language settings
$lang = $_SESSION['lang'] ?? 'en';
$lang_text = [
    'en' => ['Home' => 'Home', 'Wealth' => 'Wealth', 'Team' => 'Team', 'Task' => 'Task', 'Mine' => 'Mine'],
    'am' => ['Home' => 'መነሻ', 'Wealth' => 'ሀብት', 'Team' => 'ቡድን', 'Task' => 'ተግባር', 'Mine' => 'የእኔ'],
    'zh' => ['Home' => '主页', 'Wealth' => '财富', 'Team' => '团队', 'Task' => '任务', 'Mine' => '我的']
];
$t = $lang_text[$lang] ?? $lang_text['en'];

// Common helper functions
function getSettings($conn) {
    $settings = [];
    $result = $conn->query("SELECT * FROM settings");
    while ($row = $result->fetch_assoc()) {
        $settings[$row['setting_key']] = $row['setting_value'];
    }
    return $settings;
}

function getUserData($conn, $user_id) {
    $result = $conn->query("SELECT * FROM users WHERE id = $user_id");
    if ($result && $result->num_rows > 0) {
        return $result->fetch_assoc();
    }
    return null;
}

function getUnreadCount($conn, $user_id) {
    $result = $conn->query("SELECT COUNT(*) as count FROM messages WHERE user_id = $user_id AND is_read = 0");
    if ($result && $result->num_rows > 0) {
        return $result->fetch_assoc()['count'];
    }
    return 0;
}

function redirect($url) {
    header("Location: " . $url);
    exit();
}

function setFlash($key, $value) {
    $_SESSION['flash_' . $key] = $value;
}

function getFlash($key) {
    if (isset($_SESSION['flash_' . $key])) {
        $value = $_SESSION['flash_' . $key];
        unset($_SESSION['flash_' . $key]);
        return $value;
    }
    return null;
}

function displayFlash() {
    if ($flash = getFlash('success')) {
        echo '<div class="flash success">✅ ' . htmlspecialchars($flash) . '</div>';
    }
    if ($flash = getFlash('error')) {
        echo '<div class="flash error">❌ ' . htmlspecialchars($flash) . '</div>';
    }
    if (isset($_SESSION['errors']) && is_array($_SESSION['errors'])) {
        echo '<div class="flash error">';
        foreach ($_SESSION['errors'] as $error) {
            echo '❌ ' . htmlspecialchars($error) . '<br>';
        }
        echo '</div>';
        unset($_SESSION['errors']);
    }
}
// No trailing whitespace
?>