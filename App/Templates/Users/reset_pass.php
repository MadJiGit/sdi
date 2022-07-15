<?php include('header.php'); ?>

<title>Reset Password</title>
<h1 class="d-flex justify-content-center">Reset Password</h1>
<div class="form-group d-flex justify-content-center">
    <form method="POST">
        <div>
            <label>
                Username: <input class="form-control" placeholder="Username" type="text" name="username">
            </label>
        </div>
        <div>
            <label>
                Password: <input class="form-control" placeholder="Password" type="password" name="password">
            </label>
        </div>

        <div>
            <label>
                Confirm Password: <input class="form-control" placeholder="Password" type="password"
                                         name="confirm_password">
            </label>
        </div>
        <span>
            <input type="submit" class="btn btn-warning" name="reset_pass" value="Reset Password">
        </span>
        <span>
            <a class="btn btn-success" href="login.php" role="button">Log In</a>
    </span>
    </form>
