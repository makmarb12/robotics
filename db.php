<?php
require_once __DIR__ . '/config.php';

function getDBConnection() {
    $conn = @new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    
    if ($conn->connect_error) {
        // Try to create database if it doesn't exist
        $temp_conn = new mysqli(DB_HOST, DB_USER, DB_PASS);
        if ($temp_conn->connect_error) {
            die("Database connection failed: " . $temp_conn->connect_error);
        }
        
        // Create database
        $sql = "CREATE DATABASE IF NOT EXISTS " . DB_NAME;
        if ($temp_conn->query($sql) !== TRUE) {
            die("Error creating database: " . $temp_conn->error);
        }
        $temp_conn->close();
        
        // Connect to the new database
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
    }
    
    $conn->set_charset("utf8mb4");
    return $conn;
}

function initDatabase() {
    $conn = getDBConnection();
    
    // Users table
    $conn->query("CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(50) UNIQUE NOT NULL,
        password VARCHAR(255) NOT NULL,
        full_name VARCHAR(100),
        phone VARCHAR(20) UNIQUE,
        email VARCHAR(100) UNIQUE,
        referral_code VARCHAR(20) UNIQUE,
        referred_by VARCHAR(20),
        balance DECIMAL(10,2) DEFAULT 100,
        recharge_wallet DECIMAL(10,2) DEFAULT 0.00,
        total_income DECIMAL(10,2) DEFAULT 100,
        day_income DECIMAL(10,2) DEFAULT 0.00,
        week_income DECIMAL(10,2) DEFAULT 0.00,
        month_income DECIMAL(10,2) DEFAULT 0.00,
        team_bonus DECIMAL(10,2) DEFAULT 0.00,
        vip_no VARCHAR(50) UNIQUE,
        check_in_points INT DEFAULT 0,
        last_check_in DATE,
        role ENUM('user', 'admin') DEFAULT 'user',
        status ENUM('active', 'suspended') DEFAULT 'active',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )");

    // Robotics Products table
    $conn->query("CREATE TABLE IF NOT EXISTS products (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL,
        price DECIMAL(10,2) NOT NULL,
        total_income DECIMAL(10,2) NOT NULL,
        day_income DECIMAL(10,2) NOT NULL,
        image_url VARCHAR(255),
        status ENUM('active', 'inactive') DEFAULT 'active'
    )");

    // Insert robotics products
    $conn->query("INSERT IGNORE INTO products (name, price, total_income, day_income, image_url) VALUES
        ('Arduino Starter Kit', 500.00, 2835.00, 63.00, 'https://images.unsplash.com/photo-1518770660439-4636190af475?w=400'),
        ('Raspberry Pi 4', 1000.00, 4235.00, 145.00, 'https://images.unsplash.com/photo-1593642632823-8f785ba67e45?w=400'),
        ('Robotic Arm Kit', 1500.00, 5596.00, 238.00, 'https://images.unsplash.com/photo-1581092160607-ee22621dd758?w=400'),
        ('AI Vision System', 2000.00, 6740.00, 320.00, 'https://images.unsplash.com/photo-1558346490-a72e53ae2d4f?w=400'),
        ('Drone Kit', 3000.00, 12500.00, 480.00, 'https://images.unsplash.com/photo-1507582020474-9a35b7d455d9?w=400'),
        ('Robot Dog', 4000.00, 16800.00, 610.00, 'https://images.unsplash.com/photo-1485827404703-89b55fcc595e?w=400'),
        ('Industrial Robot', 5000.00, 20000.00, 790.00, 'https://images.unsplash.com/photo-1581092918056-0c4c3acd3789?w=400'),
        ('AI Humanoid', 10000.00, 30000.00, 1300.00, 'https://images.unsplash.com/photo-1535378917042-10a22c95931a?w=400'),
        ('Quantum Processor', 20000.00, 75000.00, 3000.00, 'https://images.unsplash.com/photo-1635070041078-e363dbe005cb?w=400'),
        ('Nano-bot Swarm', 35000.00, 120000.00, 4000.00, 'https://images.unsplash.com/photo-1614728263952-84ea256f9679?w=400')");

    // Investments table
    $conn->query("CREATE TABLE IF NOT EXISTS investments (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NOT NULL,
        product_id INT NOT NULL,
        product_name VARCHAR(100),
        amount DECIMAL(10,2) NOT NULL,
        total_income DECIMAL(10,2) DEFAULT 100,
        day_income DECIMAL(10,2) NOT NULL,
        daily_profit DECIMAL(10,2) DEFAULT 0.00,
        status ENUM('active', 'completed') DEFAULT 'active',
        purchase_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
    )");

    // Transactions table
    $conn->query("CREATE TABLE IF NOT EXISTS transactions (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NOT NULL,
        type ENUM('deposit', 'withdrawal', 'purchase', 'profit', 'bonus', 'gift') NOT NULL,
        amount DECIMAL(10,2) NOT NULL,
        status ENUM('pending', 'completed', 'failed') DEFAULT 'pending',
        payment_method VARCHAR(50),
        transaction_id VARCHAR(100),
        sender_name VARCHAR(100),
        sender_phone VARCHAR(20),
        account_number VARCHAR(50),
        reference VARCHAR(100) UNIQUE,
        description TEXT,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
    )");

    // Check-ins table
    $conn->query("CREATE TABLE IF NOT EXISTS check_ins (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NOT NULL,
        check_in_date DATE NOT NULL,
        points INT DEFAULT 1,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        UNIQUE KEY unique_checkin (user_id, check_in_date),
        FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
    )");

    // Tasks table
    $conn->query("CREATE TABLE IF NOT EXISTS tasks (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        target INT NOT NULL,
        reward DECIMAL(10,2) NOT NULL,
        task_group ENUM('group1', 'group2', 'center') DEFAULT 'group1',
        status ENUM('active', 'inactive') DEFAULT 'active'
    )");

    $conn->query("INSERT IGNORE INTO tasks (name, target, reward, task_group) VALUES
        ('Invite 5 people', 5, 500.00, 'group1'),
        ('Invite 10 people', 10, 1000.00, 'group1'),
        ('Invite 15 people', 15, 1500.00, 'group1'),
        ('Invite 30 people', 30, 3000.00, 'group1'),
        ('Invest 500 ETB', 500, 50.00, 'group2'),
        ('Invest 1000 ETB', 1000, 120.00, 'group2'),
        ('Invest 2000 ETB', 2000, 250.00, 'group2'),
        ('Earn 100 ETB daily', 100, 30.00, 'group2'),
        ('Earn 500 ETB daily', 500, 150.00, 'group2'),
        ('Complete profile', 1, 50.00, 'center'),
        ('Join Telegram channel', 1, 30.00, 'center'),
        ('First deposit', 1, 100.00, 'center'),
        ('Invite a friend', 1, 200.00, 'center'),
        ('Spin wheel 3 times', 3, 75.00, 'center')");

    // User tasks table
    $conn->query("CREATE TABLE IF NOT EXISTS user_tasks (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NOT NULL,
        task_id INT NOT NULL,
        progress INT DEFAULT 0,
        completed BOOLEAN DEFAULT FALSE,
        reward_claimed BOOLEAN DEFAULT FALSE,
        week_start DATE,
        FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
        FOREIGN KEY (task_id) REFERENCES tasks(id) ON DELETE CASCADE,
        UNIQUE KEY unique_user_task_week (user_id, task_id, week_start)
    )");

    // Referrals table
    $conn->query("CREATE TABLE IF NOT EXISTS referrals (
        id INT AUTO_INCREMENT PRIMARY KEY,
        referrer_id INT NOT NULL,
        referred_id INT NOT NULL,
        level ENUM('A', 'B', 'C') DEFAULT 'B',
        commission_earned DECIMAL(10,2) DEFAULT 0.00,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (referrer_id) REFERENCES users(id) ON DELETE CASCADE,
        FOREIGN KEY (referred_id) REFERENCES users(id) ON DELETE CASCADE,
        UNIQUE KEY unique_referral (referrer_id, referred_id)
    )");

    // Financial records table
    $conn->query("CREATE TABLE IF NOT EXISTS financial_records (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NOT NULL,
        record_type ENUM('income', 'expense', 'withdrawal', 'deposit') NOT NULL,
        amount DECIMAL(10,2) NOT NULL,
        category VARCHAR(50),
        description TEXT,
        record_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
    )");

    // Messages table
    $conn->query("CREATE TABLE IF NOT EXISTS messages (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NOT NULL,
        title VARCHAR(255),
        content TEXT,
        is_read BOOLEAN DEFAULT FALSE,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
    )");

    // Settings table
    $conn->query("CREATE TABLE IF NOT EXISTS settings (
        id INT AUTO_INCREMENT PRIMARY KEY,
        setting_key VARCHAR(50) UNIQUE,
        setting_value TEXT
    )");

    $conn->query("INSERT IGNORE INTO settings (setting_key, setting_value) VALUES
        ('exchange_rate', '1.00'),
        ('referral_code', 'robotech2024'),
        ('website_name', 'RoboTech AI'),
        ('website_url', 'http://localhost/robotics')");

    // Create admin user if not exists
    $check_admin = $conn->query("SELECT id FROM users WHERE role = 'admin'");
    if ($check_admin->num_rows == 0) {
        $admin_pass = password_hash('admin123', PASSWORD_DEFAULT);
        $vip = 'VIP' . rand(100000000, 999999999);
        $ref_code = 'ADMIN' . rand(1000, 9999);
        $conn->query("INSERT INTO users (username, password, full_name, role, vip_no, referral_code) 
                      VALUES ('admin', '$admin_pass', 'Administrator', 'admin', '$vip', '$ref_code')");
    }

    return $conn;
}
// No trailing whitespace
?>