<?php
if (isLoggedIn()) {
    redirect('index.php?action=home');
}
?>
<div class="container">
    <div class="auth-card">
        <h2>🤖 Join RoboTech AI</h2>
        <p>Start your robotics investment journey</p>
        
        <form method="POST" action="index.php?action=register">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="full_name">Full Name</label>
                <input type="text" id="full_name" name="full_name" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="phone">Phone (9-15 digits)</label>
                <input type="text" id="phone" name="phone" required>
            </div>
            <div class="form-group">
                <label for="password">Password (min 6 characters)</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="referral">Referral Code (optional)</label>
                <input type="text" id="referral" name="referral" placeholder="<?php echo REFERRAL_CODE; ?>">
            </div>
            <button type="submit" name="register" class="btn">Register</button>
        </form>
        
        <p class="auth-link">Already have an account? <a href="index.php?action=login">Login</a></p>
    </div>
</div>