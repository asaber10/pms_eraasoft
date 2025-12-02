<?php
require_once 'inc/header.php';

// لو المستخدم داخل بالفعل (فيه session user)
// نرجعه ع الصفحة الرئيسية
if (isset($_SESSION['user'])) {
    header("Location: index.php");
    exit;
}
?>

<div class="register-box">
    <h2>Login</h2>

    <?php if (!empty($_SESSION['login_errors'])): ?>
        <div class="errors">
            <?php foreach ($_SESSION['login_errors'] as $error): ?>
                <p>• <?= htmlspecialchars($error) ?></p>
            <?php endforeach; ?>
        </div>
        <?php unset($_SESSION['login_errors']); ?>
    <?php endif; ?>

    <?php if (!empty($_SESSION['success'])): ?>
        <div class="success">
            <p><?= htmlspecialchars($_SESSION['success']); ?></p>
        </div>
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>

    <form action="handler/login_handler.php" method="POST">
        <div class="input-group">
            <label>Email</label>
            <input type="email" name="email" required>
        </div>

        <div class="input-group">
            <label>Password</label>
            <input type="password" name="password" required>
        </div>

        <button type="submit" class="btn">Login</button>
    </form>
</div>

<?php require_once 'inc/footer.php'; ?>
