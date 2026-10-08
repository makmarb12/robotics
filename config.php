<?php
// ============================================
// DATABASE CONFIGURATION
// ============================================
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'robotics_fund');

// ============================================
// BANKING CONSTANTS
// ============================================
define('BANK_ACCOUNT', '1000740191857');
define('BANK_NAME', 'Commercial Bank of Ethiopia');
define('ACCOUNT_NAME', 'Mekuanint Maru');
define('MIN_DEPOSIT', 1000);
define('MAX_DEPOSIT', 1000000);
define('REFERRAL_CODE', 'robotech2024');

// ============================================
// APPLICATION SETTINGS
// ============================================
define('SITE_NAME', 'RoboTech AI');
define('SITE_URL', 'https://robotech.ethiopia.com');
define('SITE_TAGLINE', 'Invest in the Future of Robotics');

// ============================================
// ERROR REPORTING
// ============================================
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>