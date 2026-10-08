<?php if (isset($_SESSION['user_id'])): ?>
    <div class="footer">
        <p>&copy; <?php echo date('Y'); ?> <?php echo SITE_NAME; ?></p>
        <p style="font-size: 0.8rem; opacity: 0.7;"><?php echo SITE_TAGLINE; ?></p>
    </div>
<?php endif; ?>
    </div>
</body>
</html>
<?php // No trailing whitespace ?>