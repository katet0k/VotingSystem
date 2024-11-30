<?php include __DIR__ . '/../layout/header.php'; ?>

    <div class="container mt-5">
        <h2>Управление кандидатами</h2>
        <form method="GET" action="">
            <div class="form-group">
                <label for="election_id">Выберите голосование:</label>
                <select name="election_id" class="form-control" onchange="this.form.submit()">
                    <option value="">-- Выберите --</option>
                    <?php foreach ($elections as $election): ?>
                        <option value="<?php echo $election['id']; ?>" <?php echo ($selectedElectionId == $election['id']) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($election['title']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </form>

        <?php if ($selectedElectionId): ?>
            <a href="/admin/create_candidate.php?election_id=<?php echo $selectedElectionId; ?>" class="btn btn-success mb-3">Добавить кандидата</a>
            <?php if (!empty($candidates)): ?>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Имя</th>
                        <th>Описание</th>
                        <th>Действия</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($candidates as $candidate): ?>
                        <tr>
                            <td><?php echo $candidate['id']; ?></td>
                            <td><?php echo htmlspecialchars($candidate['name']); ?></td>
                            <td><?php echo htmlspecialchars($candidate['description']); ?></td>
                            <td>
                                <a href="/admin/edit_candidate.php?id=<?php echo $candidate['id']; ?>" class="btn btn-primary btn-sm">Редактировать</a>
                                <a href="/admin/delete_candidate.php?id=<?php echo $candidate['id']; ?>&election_id=<?php echo $selectedElectionId; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Вы уверены, что хотите удалить этого кандидата?');">Удалить</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>Нет кандидатов для этого голосования.</p>
            <?php endif; ?>
        <?php else: ?>
            <p>Пожалуйста, выберите голосование для управления кандидатами.</p>
        <?php endif; ?>
    </div>

<?php include __DIR__ . '/../layout/footer.php'; ?>