<?php
if (isset($_GET['set_lang'])) {
    $_SESSION['lang'] = $_GET['set_lang'];
    setFlash('success', "Language updated!");
    redirect('index.php?action=settings');
}
?>