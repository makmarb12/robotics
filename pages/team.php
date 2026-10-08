<?php
requireLogin();
$user_data = getUserData($conn, $_SESSION['user_id']);
$referrals = $conn->query("SELECT u.username, u.full_name, u.created_at, r.level FROM referrals r 
                          JOIN users u ON r.referred_id = u.id WHERE r.referrer_id = " . $_SESSION['user_id']);
$referral_count = $referrals ? $referrals->num_rows : 0;
?>
<div class="container">
    <h2>Your Robotics Team</h2>
    
    <div class="team-stats">
        <div class="stat-item">
            <div class="stat-value"><?php echo $referral_count; ?></div>
            <div class="stat-label">Team Members</div>
        </div>
        <div class="stat-item">
            <div class="stat-value"><?php echo number_format($user_data['team_bonus'], 2); ?> ETB</div>
            <div class="stat-label">Team Bonus</div>
        </div>
    </div>

    <div class="referral-code">
        <h3>Your Referral Code</h3>
        <div class="code-box"><?php echo $user_data['referral_code']; ?></div>
        <p>Share this code to build your robotics team!</p>
    </div>

    <h3>Team Members</h3>
    <?php if ($referrals && $referrals->num_rows > 0): ?>
        <div class="team-list">
            <?php while ($member = $referrals->fetch_assoc()): ?>
            <div class="team-member">
                <div class="member-name"><?php echo $member['full_name']; ?></div>
                <div class="member-username">@<?php echo $member['username']; ?></div>
                <div class="member-level">Level: <?php echo $member['level']; ?></div>
                <div class="member-date">Joined: <?php echo date('M d, Y', strtotime($member['created_at'])); ?></div>
            </div>
            <?php endwhile; ?>
        </div>
    <?php else: ?>
        <p>No team members yet. Invite friends to join!</p>
    <?php endif; ?>
</div>