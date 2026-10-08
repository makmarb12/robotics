<?php
require_once __DIR__ . '/../auth.php';
requireLogin();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['purchase_robot'])) {
    $product_id = intval($_POST['product_id']);
    $product = $conn->query("SELECT * FROM products WHERE id = $product_id")->fetch_assoc();
    
    if ($product) {
        $amount = $product['price'];
        $user = $conn->query("SELECT balance FROM users WHERE id = " . $_SESSION['user_id'])->fetch_assoc();
        
        if ($amount <= $user['balance']) {
            $conn->query("UPDATE users SET balance = balance - $amount WHERE id = " . $_SESSION['user_id']);
            
            $stmt = $conn->prepare("INSERT INTO investments (user_id, product_id, product_name, amount, total_income, day_income, daily_profit) 
                                   VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("iisdddd", $_SESSION['user_id'], $product_id, $product['name'], $amount, 
                            $product['total_income'], $product['day_income'], $product['day_income']);
            $stmt->execute();
            
            $conn->query("UPDATE users SET total_income = total_income + {$product['total_income']}, 
                        day_income = day_income + {$product['day_income']} WHERE id = " . $_SESSION['user_id']);
            
            $_SESSION['balance'] = $user['balance'] - $amount;
            setFlash('success', "Robotics kit purchased successfully!");
        } else {
            setFlash('error', "Insufficient balance");
        }
    }
    redirect('index.php?action=home');
}
?>
