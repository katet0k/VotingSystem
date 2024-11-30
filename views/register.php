<?php include 'layout/header.php'; ?>

    <div class="container mt-5">
        <h2>Регистрация</h2>
        <?php if (!empty($errors)): ?>
            <div class="alert alert-danger">
                <?php foreach ($errors as $error): ?>
                    <p><?php echo htmlspecialchars($error); ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        <form action="/register.php" method="POST">
            <div class="form-group">
                <label for="username">Имя пользователя:</label>
                <input type="text" name="username" class="form-control" required value="<?php echo isset($username) ? htmlspecialchars($username) : ''; ?>">
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" class="form-control" required value="<?php echo isset($email) ? htmlspecialchars($email) : ''; ?>">
            </div>
            <div class="form-group">
                <label for="password">Пароль:</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="confirm_password">Подтверждение пароля:</label>
                <input type="password" name="confirm_password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Зарегистрироваться</button>
        </form>
        <p class="mt-3">Уже есть аккаунт? <a href="/login.php">Войти</a></p>
    </div>

<?php include 'layout/footer.php'; ?>