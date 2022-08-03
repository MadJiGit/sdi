<?php include('header.php'); ?>
<title>Sign In</title>
<h1 class="d-flex justify-content-center">Login</h1>
<div class="form-group d-flex justify-content-center">
    <form method="POST">
        <div>
            <label>
                Username/Email: <input class="form-control" placeholder="Username/Email" type="text" name="data">
            </label>
        </div>

        <div>
            <label>
                Password: <input class="form-control" placeholder="Password" type="password" name="password" id="pass">
                <input type="checkbox" onclick="myFunction('pass')">  show password
            </label>
        </div>
        <div>
            <label>
                <input type="checkbox" name="remember"> Запомни ме
            </label>

        </div>

        <span>
                <input type="submit" class="btn btn-primary" name="login" value="Sign In">
        </span>
        <span>
            <a class="btn btn-success" href="register.php" role="button">Register</a>
        </span>
        <span>
            <a class="btn btn-warning" href="forget_pass.php" role="button">Forget Password</a>
        </span>
    </form>
</div>

<?php include('footer.php'); ?>

