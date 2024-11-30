<?php include 'layout/header.php'; ?>

    <div class="container mt-5">
        <h2><?php echo htmlspecialchars($election['title']); ?></h2>
        <p><?php echo htmlspecialchars($election['description']); ?></p>

        <?php if (!empty($error)): ?>
            <div class="alert alert-danger">
                <p><?php echo htmlspecialchars($error); ?></p>
            </div>
        <?php elseif (!empty($success)): ?>
            <div class="alert alert-success">
                <p><?php echo htmlspecialchars($success); ?></p>
            </div>
        <?php else: ?>
            <form action="" method="POST">
                <?php foreach ($candidates as $candidate): ?>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="candidate_id" value="<?php echo $candidate['id']; ?>" required>
                        <label class="form-check-label">
                            <?php echo htmlspecialchars($candidate['name']); ?> - <?php echo htmlspecialchars($candidate['description']); ?>
                        </label>
                    </div>
                <?php endforeach; ?>
                <button type="submit" class="btn btn-primary mt-3">Голосовать</button>
            </form>
        <?php endif; ?>
    </div>

<?php include 'layout/footer.php'; ?>