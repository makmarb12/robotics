<?php
// No whitespace before this line - file must start with <?php
// No BOM (Byte Order Mark) in file
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes">
    <title><?php echo SITE_NAME; ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', sans-serif; }
        #bg-video {
            position: fixed;
            top: 0;
            left: 0;
            min-width: 100%;
            min-height: 100%;
            width: auto;
            height: auto;
            z-index: -1;
            object-fit: cover;
            opacity: 0.8;
        }
        body {
            min-height: 100vh;
            background: transparent;
        }
        .container {
            max-width: 500px;
            margin: 0 auto;
            padding: 15px;
            background: rgba(0, 123, 255, 0.85);
            border-radius: 20px 20px 0 0;
            backdrop-filter: blur(5px);
            box-shadow: 0 -5px 20px rgba(0,0,0,0.1);
            color: white;
        }
        .app-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 15px;
            padding: 15px;
            margin-bottom: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        .logo {
            font-size: 1.2rem;
            font-weight: 700;
        }
        .logo span {
            color: #ffd700;
            font-size: 0.9rem;
            margin-left: 5px;
        }
        .header-icons a {
            color: white;
            position: relative;
            margin-left: 15px;
        }
        .badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background: #ff4444;
            color: white;
            font-size: 0.6rem;
            padding: 2px 5px;
            border-radius: 10px;
        }
        .flash {
            padding: 12px;
            margin-bottom: 15px;
            border-radius: 8px;
            font-weight: 500;
        }
        .flash.success {
            background: #28a745;
            color: white;
        }
        .flash.error {
            background: #dc3545;
            color: white;
        }
        .btn {
            width: 100%;
            padding: 15px;
            background: #ffd700;
            color: #000;
            border: none;
            border-radius: 8px;
            font-weight: 700;
            cursor: pointer;
        }
        .btn:hover {
            background: #ffed4a;
        }
        .btn-outline {
            background: transparent;
            border: 2px solid #ffd700;
            color: #ffd700;
            margin-top: 5px;
        }
        .btn-outline:hover {
            background: #ffd700;
            color: #000;
        }
        .btn-small {
            padding: 5px 10px;
            font-size: 0.8rem;
            width: auto;
            display: inline-block;
            margin: 2px;
        }
        .btn-danger {
            background: #dc3545;
        }
        .btn-danger:hover {
            background: #c82333;
        }
        .auth-card {
            max-width: 400px;
            margin: 20px auto;
            background: rgba(255,255,255,0.1);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 30px;
            border: 1px solid rgba(255,255,255,0.2);
        }
        .auth-card h2 {
            text-align: center;
            margin-bottom: 10px;
            color: #ffd700;
        }
        .auth-card p {
            text-align: center;
            margin-bottom: 20px;
            color: rgba(255,255,255,0.8);
        }
        .auth-link {
            text-align: center;
            margin-top: 15px;
            color: rgba(255,255,255,0.8);
        }
        .auth-link a {
            color: #ffd700;
            text-decoration: none;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: 500;
        }
        .form-group input, .form-group select, .form-group textarea {
            width: 100%;
            padding: 12px;
            background: rgba(255,255,255,0.9);
            border: 1px solid rgba(255,255,255,0.3);
            border-radius: 8px;
            color: #333;
        }
        .stat-item {
            background: rgba(255,255,255,0.15);
            backdrop-filter: blur(10px);
            border-radius: 12px;
            padding: 15px;
            text-align: center;
            border: 1px solid rgba(255,255,255,0.2);
        }
        .stat-value {
            font-size: 1.5rem;
            font-weight: 700;
            color: #ffd700;
        }
        .stat-label {
            font-size: 0.8rem;
            color: rgba(255,255,255,0.8);
            margin-top: 5px;
        }
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
            margin-bottom: 15px;
        }
        .products-grid {
            display: grid;
            gap: 15px;
        }
        .product-card {
            background: rgba(255,255,255,0.1);
            border-radius: 12px;
            padding: 15px;
            display: flex;
            align-items: center;
            gap: 15px;
            border: 1px solid rgba(255,255,255,0.2);
            margin-bottom: 10px;
        }
        .product-image {
            width: 80px;
            height: 80px;
            border-radius: 10px;
            object-fit: cover;
        }
        .product-info { flex: 1; }
        .product-info h3 { color: #ffd700; margin-bottom: 5px; }
        .product-price { font-size: 1.2rem; font-weight: 700; }
        .product-income { color: #90ee90; font-size: 0.9rem; }
        .buy-btn {
            background: #ffd700;
            color: #000;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
        }
        .buy-btn:hover {
            background: #ffed4a;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
        }
        .table th, .table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid rgba(255,255,255,0.2);
        }
        .table th {
            color: #ffd700;
            font-weight: 600;
        }
        .investment-item, .team-member, .transaction-item, .task-card {
            background: rgba(255,255,255,0.1);
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 10px;
            border: 1px solid rgba(255,255,255,0.1);
        }
        .code-box {
            background: rgba(255,255,255,0.2);
            padding: 15px;
            border-radius: 8px;
            text-align: center;
            font-size: 1.5rem;
            font-weight: 700;
            letter-spacing: 2px;
            margin: 10px 0;
        }
        .progress-bar {
            width: 100%;
            height: 20px;
            background: rgba(255,255,255,0.2);
            border-radius: 10px;
            overflow: hidden;
            margin: 5px 0;
        }
        .progress-fill {
            height: 100%;
            background: #ffd700;
            transition: width 0.3s;
        }
        .bank-details {
            background: rgba(255,255,255,0.1);
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
        }
        .balance-info {
            background: rgba(255,215,0,0.2);
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            text-align: center;
        }
        .footer {
            text-align: center;
            padding: 20px;
            color: rgba(255,255,255,0.6);
            font-size: 0.9rem;
        }
        @media (max-width: 480px) {
            .product-card {
                flex-direction: column;
                text-align: center;
            }
            .product-image {
                width: 100%;
                height: 150px;
            }
        }
    </style>
</head>
<body>
    <video autoplay muted loop id="bg-video">
        <source src="https://assets.mixkit.co/videos/preview/mixkit-robotics-and-technology-background-2395.mp4" type="video/mp4">
    </video>
    
    <?php if (isset($_SESSION['user_id'])): ?>
    <div class="container">
        <div class="app-header">
            <div class="logo">
                🤖 <?php echo SITE_NAME; ?>
                <span><?php echo SITE_TAGLINE; ?></span>
            </div>
            <div class="header-icons">
                <a href="index.php?action=settings">
                    <i class="fas fa-cog"></i>
                </a>
                <?php if (isAdmin()): ?>
                <a href="index.php?action=admin">
                    <i class="fas fa-user-shield"></i>
                </a>
                <?php endif; ?>
                <a href="index.php?action=logout">
                    <i class="fas fa-sign-out-alt"></i>
                </a>
            </div>
        </div>
    <?php else: ?>
    <div class="container">
    <?php endif; ?>
<?php // No trailing whitespace after this closing tag ?>