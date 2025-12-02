<?php
session_start();
require_once 'inc/header.php';
?>

<div class="register-box">

    <h2>Create Account</h2>

    <?php if (!empty($_SESSION['reg_errors'])): ?>
        <div class="errors">
            <?php foreach ($_SESSION['reg_errors'] as $error): ?>
                <p>• <?= $error ?></p>
            <?php endforeach; ?>
        </div>
        <?php unset($_SESSION['reg_errors']); ?>
    <?php endif; ?>

    <form action="handler/register_handler.php" method="POST">

        <div class="input-group">
            <label>Name</label>
            <input type="text" name="name">
        </div>

        <div class="input-group">
            <label>Email</label>
            <input type="email" name="email">
        </div>

        <div class="input-group">
            <label>Password</label>
            <input type="password" name="password">
        </div>

        <div class="input-group">
            <label>Confirm Password</label>
            <input type="password" name="confirm_password">
        </div>

        <button type="submit" class="btn">Register</button>

    </form>

</div>

<?php require_once 'inc/footer.php'; ?>
