<div class="container ">
    <div class="row justify-content-center">
        <div class="col-lg-4">
            <form action="<?= $action ?>" method="post">
                <div class="form-group">
                    <label for="Login">Login</label>
                    <input class="form-control" id="Login" name="login" placeholder="Введите логин">
                </div>
                <div class="form-group">
                    <label for="Password">Password</label>
                    <input type="password" class="form-control" name="password" id="Password" placeholder="Введите пароль">
                </div>
                <button type="submit" class="btn btn-primary">Логин</button>
            </form>
        </div>
    </div>
</div>
