<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title>MVC</title>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link href="/Static/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="/Static/css/bootstrap-grid.min.css" rel="stylesheet" type="text/css">
    <link href="/Static/css/bootstrap-reboot.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet">
</head>
<body>
<header class="p-3">
    <div class="container">
        <div class="row text-center">
            <div class="col-lg-4"><a href="/">Задачник</a></div>
            <div class="col-lg-4"></div>
            <?php if ($isLogged) { ?>
                <div class="col-lg-4"><a href="/Login/signOut" class="btn btn-outline-primary">Выйти</a></div>
            <?php } else { ?>
                <div class="col-lg-4"><a href="/Login" class="btn btn-primary">Войти</a></div>
            <?php } ?>
        </div>
    </div>
</header>
<div class="main">
    <div class="container">
        <?php if (isset($alert)) echo $alert; ?>
    </div>
    <?= $body ?>
</div>
</body>
</html>