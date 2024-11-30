<?php include 'layout/header.php'; ?>

    <div class="container mt-5">
        <h2>Вход</h2>
        <?php if (!empty($errors)): ?>
            <div class="alert alert-danger">
                <?php foreach ($errors as $error): ?>
                    <p><?php echo htmlspecialchars($error); ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        <form action="/login.php" method="POST">
            <div class="form-group">
                <label for="username">Имя пользователя или Email:</label>
                <input type="text" name="username" class="form-control" required value="<?php echo isset($username) ? htmlspecialchars($username) : ''; ?>">
            </div>
            <div class="form-group">
                <label for="password">Пароль:</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Войти</button>
        </form>
        <p class="mt-3">Нет аккаунта? <a href="/register.php">Зарегистрироваться</a></p>
    </div>

<?php include 'layout/footer.php'; ?>