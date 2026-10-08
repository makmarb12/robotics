<?php
requireLogin();
$user_data = getUserData($conn, $_SESSION['user_id']);
?>
<div class="container">
    <h2>🎡 Wheel of Fortune</h2>
    
    <div class="wheel-info">
        <p>Spin the wheel and win prizes!</p>
        <p>Cost: 10 points per spin</p>
        <p>Your Points: <?php echo $user_data['check_in_points']; ?></p>
    </div>
    
    <div class="wheel-prizes">
        <h3>Prizes:</h3>
        <ul>
            <li>5 ETB</li>
            <li>10 ETB</li>
            <li>20 ETB</li>
            <li>50 ETB</li>
            <li>100 ETB</li>
            <li>0 ETB</li>
        </ul>
    </div>
    
    <a href="index.php?action=spin_wheel&spin_wheel=1" class="btn">Spin Wheel (10 points)</a>
</div>