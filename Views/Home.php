<?php
$savePage = null;

if (isset($page) && !empty($page)) {
    $savePage = "&page=$page";
}
?>
<div class="container">
    <div class="row m-3 justify-content-end">
        <a href="/Tasks/add" class="btn btn-success align-self-end">Добавить</a>
    </div>
    <?php if (!$tasks) { ?>
        <div class="alert alert-secondary" role="alert">
            Задач не найдено
        </div>
    <?php } else { ?>
    <table class="table">
        <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">
                <a href="?orderBy=username&orderDirection=<?php
                if ($orderBy === 'username' && $orderDirection === 'ASC') echo 'DESC'; else echo 'ASC';
                ?><?= $savePage ?>" >
                    Имя пользователя
                </a>
            </th>
            <th scope="col">
                <a href="?orderBy=email&orderDirection=<?php
                if ($orderBy === 'email' && $orderDirection === 'ASC') echo 'DESC'; else echo 'ASC';
                ?><?= $savePage ?>">
                    E-mail
                </a>
            </th>
            <th scope="col">Текст задачи</th>
            <th scope="col">
                <a href="?orderBy=ready&orderDirection=<?php
                if ($orderBy === 'ready' && $orderDirection === 'ASC') echo 'DESC'; else echo 'ASC';
                ?><?= $savePage ?>">
                    Статус
                </a>
            </th>
            <?php if ($isLogged) { ?>
                <th scope="col"></th>
            <?php } ?>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($tasks as $task) { ?>
            <tr>
                <th scope="row"><?= $task->id ?></th>
                <td><?= htmlspecialchars($task->username) ?></td>
                <td><?= $task->email ?></td>
                <td><?= htmlspecialchars($task->description) ?></td>
                <td>
                    <?php if ($task->ready) { ?>
                        <span class="badge badge-success">Выполнено</span>
                    <?php } ?>
                    <?php if ($task->changed) { ?>
                        <br><span class="badge badge-secondary">Отредактировано администратором</span>
                    <?php } ?>
                </td>
                <?php if ($isLogged) { ?>
                    <td><a class="btn btn-secondary" href="/Tasks/edit?id=<?= $task->id ?>" role="button">Редактировать</a></td>
                <?php } ?>
            </tr>
        <?php } ?>
        </tbody>
    </table>
    <?= $pagination ?>
    <?php } ?>
</div>
