<div class="container">
    <form method="post">
        <div class="form-group">
            <label for="username">Имя пользователя</label>
            <input type="text" class="form-control" id="username" name="username" value="<?= $task->username ?>" placeholder="login" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="<?= $task->email ?>" placeholder="name@example.com" required>
        </div>
        <div class="form-group">
            <label for="description">Описание</label>
            <textarea class="form-control" id="description" name="description" rows="3" required><?= $task->description ?></textarea>
        </div>
        <div class="form-check">
            <input type="checkbox" class="form-check-input" <?php if ($task->ready) echo 'checked'; ?> name="ready" id="ready">
            <label class="form-check-label"  for="ready">Выполнено</label>
        </div>
        <button type="submit" class="btn btn-success">Сохранить</button>
    </form>
</div>