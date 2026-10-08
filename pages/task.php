<?php
requireLogin();
$user_data = getUserData($conn, $_SESSION['user_id']);
$tasks = $conn->query("SELECT * FROM tasks WHERE status = 'active'");
?>
<div class="container">
    <h2>Robotics Tasks</h2>
    
    <div class="daily-gift">
        <h3>Daily Gift</h3>
        <p>Claim your daily reward!</p>
        <a href="index.php?action=claim_gift" class="btn">Claim Gift</a>
    </div>

    <h3>Available Tasks</h3>
    <?php while ($task = $tasks->fetch_assoc()): ?>
    <div class="task-card">
        <div class="task-name"><?php echo $task['name']; ?></div>
        <div class="task-target">Target: <?php echo $task['target']; ?></div>
        <div class="task-reward">Reward: <?php echo number_format($task['reward'], 2); ?> ETB</div>
        <div class="task-progress">
            <?php 
            $progress = $conn->query("SELECT progress FROM user_tasks WHERE user_id = " . $_SESSION['user_id'] . 
                                    " AND task_id = " . $task['id'] . " AND week_start = CURDATE()");
            $current = $progress && $progress->num_rows > 0 ? $progress->fetch_assoc()['progress'] : 0;
            $percentage = $task['target'] > 0 ? min(100, ($current / $task['target']) * 100) : 0;
            ?>
            <div class="progress-bar">
                <div class="progress-fill" style="width: <?php echo $percentage; ?>%"></div>
            </div>
            <div class="progress-text"><?php echo $current; ?>/<?php echo $task['target']; ?></div>
        </div>
    </div>
    <?php endwhile; ?>
</div>