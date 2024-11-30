<?php include __DIR__ . '/../layout/header.php'; ?>

    <div class="container mt-5">
        <h2>Добавить кандидата</h2>
        <?php if (!empty($errors)): ?>
            <div class="alert alert-danger">
                <?php foreach ($errors as $error): ?>
                    <p><?php echo htmlspecialchars($error); ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        <form action="" method="POST">
            <div class="form-group">
                <label for="name">Имя:</label>
                <input type="text" name="name" class="form-control" required value="<?php echo isset($name) ? htmlspecialchars($name) : ''; ?>">
            </div>
            <div class="form-group">
                <label for="description">Описание:</label>
                <textarea name="description" class="form-control"><?php echo isset($description) ? htmlspecialchars($description) : ''; ?></textarea>
            </div>
            <button type="submit" class="btn btn-success">Добавить</button>
            <a href="/admin/candidates.php?election_id=<?php echo $electionId; ?>" class="btn btn-secondary">Отмена</a>
        </form>
    </div>

<?php include __DIR__ . '/../layout/footer.php'; ?>