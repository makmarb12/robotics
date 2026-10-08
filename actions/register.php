<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $full_name = trim($_POST['full_name']);
    $phone = trim($_POST['phone']);
    $email = trim($_POST['email']);
    $referral = isset($_POST['referral']) ? trim($_POST['referral']) : REFERRAL_CODE;
    
    $errors = [];
    if (strlen($password) < 6) $errors[] = "Password must be at least 6 characters";
    if (!preg_match('/^[0-9]{9,15}$/', $phone)) $errors[] = "Invalid phone number";
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Invalid email";
    
    $vip_no = 'RB' . rand(10000000, 99999999);
    $ref_code = substr(md5(uniqid()), 0, 8);
    
    if (empty($errors)) {
        $hashed = password_hash($password, PASSWORD_DEFAULT);
        $full_phone = '+251' . $phone;
        
        $stmt = $conn->prepare("INSERT INTO users (username, password, full_name, phone, email, vip_no, referral_code, referred_by) 
                                VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssss", $username, $hashed, $full_name, $full_phone, $email, $vip_no, $ref_code, $referral);
        
        if ($stmt->execute()) {
            $user_id = $stmt->insert_id;
            $conn->query("INSERT INTO messages (user_id, title, content) 
                         VALUES ($user_id, 'Welcome to RoboTech AI!', 'Start your robotics investment journey today!')");
            setFlash('success', "Registration successful! Your VIP: $vip_no");
            redirect('index.php?action=login');
        } else {
            $errors[] = "Registration failed - username or email may already exist";
        }
    }
    
    $_SESSION['errors'] = $errors;
    redirect('index.php?action=register');
}
?>
