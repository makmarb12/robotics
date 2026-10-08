<?php
if (isLoggedIn()) {
    redirect('index.php?action=home');
}
?>
<div class="container">
    <div class="auth-card">
        <h2>🤖 RoboTech AI</h2>
        <p>Login to your robotics investment account</p>
        
        <form method="POST" action="index.php?action=login">
            <div class="form-group">
                <label for="username">Username or Email</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" name="login" class="btn">Login</button>
        </form>
        
        <p class="auth-link">Don't have an account? <a href="index.php?action=register">Register</a></p>
    </div>
</div>