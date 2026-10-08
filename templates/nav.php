<?php if (isset($_SESSION['user_id'])): ?>
<div class="nav-tabs" style="display: flex; background: rgba(255,255,255,0.1); border-radius: 12px; padding: 5px; margin-bottom: 20px;">
    <a href="index.php?action=home" class="nav-tab" style="flex: 1; text-align: center; padding: 12px 5px; color: rgba(255,255,255,0.7); text-decoration: none; font-size: 0.9rem; border-radius: 8px; transition: all 0.3s; <?php echo $action == 'home' ? 'background: #ffd700; color: #000;' : ''; ?>">
        <i class="fas fa-home" style="display: block; font-size: 1.2rem; margin-bottom: 3px;"></i>
        <?php echo $t['Home']; ?>
    </a>
    <a href="index.php?action=wealth" class="nav-tab" style="flex: 1; text-align: center; padding: 12px 5px; color: rgba(255,255,255,0.7); text-decoration: none; font-size: 0.9rem; border-radius: 8px; transition: all 0.3s; <?php echo $action == 'wealth' ? 'background: #ffd700; color: #000;' : ''; ?>">
        <i class="fas fa-chart-line" style="display: block; font-size: 1.2rem; margin-bottom: 3px;"></i>
        <?php echo $t['Wealth']; ?>
    </a>
    <a href="index.php?action=team" class="nav-tab" style="flex: 1; text-align: center; padding: 12px 5px; color: rgba(255,255,255,0.7); text-decoration: none; font-size: 0.9rem; border-radius: 8px; transition: all 0.3s; <?php echo $action == 'team' ? 'background: #ffd700; color: #000;' : ''; ?>">
        <i class="fas fa-users" style="display: block; font-size: 1.2rem; margin-bottom: 3px;"></i>
        <?php echo $t['Team']; ?>
    </a>
    <a href="index.php?action=task" class="nav-tab" style="flex: 1; text-align: center; padding: 12px 5px; color: rgba(255,255,255,0.7); text-decoration: none; font-size: 0.9rem; border-radius: 8px; transition: all 0.3s; <?php echo $action == 'task' ? 'background: #ffd700; color: #000;' : ''; ?>">
        <i class="fas fa-tasks" style="display: block; font-size: 1.2rem; margin-bottom: 3px;"></i>
        <?php echo $t['Task']; ?>
    </a>
    <a href="index.php?action=mine" class="nav-tab" style="flex: 1; text-align: center; padding: 12px 5px; color: rgba(255,255,255,0.7); text-decoration: none; font-size: 0.9rem; border-radius: 8px; transition: all 0.3s; <?php echo $action == 'mine' ? 'background: #ffd700; color: #000;' : ''; ?>">
        <i class="fas fa-user" style="display: block; font-size: 1.2rem; margin-bottom: 3px;"></i>
        <?php echo $t['Mine']; ?>
    </a>
</div>
<?php endif; ?>