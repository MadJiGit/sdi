<?php include('header.php'); ?>
<title>Register</title>
<h1 class="d-flex justify-content-center">Register</h1>
<div class="form-group d-flex justify-content-center">
    <form method="POST">
        <div>
            <label>
                Username: <input class="form-control" placeholder="Username" type="text" name="username" value="">
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

        <div>
            <label>
                Email: <input type="text" class="form-control" placeholder="Email" name="email" value="">
            </label>
        </div>

        <div>
            <label>
                EGN: <input type="text" class="form-control" placeholder="EGN" name="egn" value="">
            </label>
        </div>
        <span>
        <input type="submit" class="btn btn-primary" name="register" value="Register">
    </span>
        <span>
            <a class="btn btn-success" href="login.php" role="button">Sign In</a>
    </span>
    </form>
