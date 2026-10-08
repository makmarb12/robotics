<?php
requireLogin();
$user_data = getUserData($conn, $_SESSION['user_id']);
?>
<div class="container">
    <h2>Profile Settings</h2>
    
    <form method="POST" action="index.php?action=update_profile">
        <div class="form-group">
            <label for="full_name">Full Name</label>
            <input type="text" id="full_name" name="full_name" value="<?php echo $user_data['full_name']; ?>" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="<?php echo $user_data['email']; ?>" required>
        </div>
        <div class="form-group">
            <label for="current_password">Current Password</label>
            <input type="password" id="current_password" name="current_password" required>
        </div>
        <div class="form-group">
            <label for="new_password">New Password (leave blank to keep current)</label>
            <input type="password" id="new_password" name="new_password">
        </div>
        <button type="submit" name="update_profile" class="btn">Update Profile</button>
    </form>
    
    <div class="language-section">
        <h3>Language</h3>
        <a href="index.php?action=language&set_lang=en" class="btn btn-outline">English</a>
        <a href="index.php?action=language&set_lang=am" class="btn btn-outline">አማርኛ</a>
        <a href="index.php?action=language&set_lang=zh" class="btn btn-outline">中文</a>
    </div>
</div>