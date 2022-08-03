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
                Password: <input class="form-control" placeholder="Password" type="password" name="password" id="pass">
                <input type="checkbox" onclick="myFunction('pass')">  show password
            </label>
        </div>

        <div>
            <label>
                Confirm Password: <input class="form-control" placeholder="Password" type="password"
                                         name="confirm_password" id="conf_pass">
                <input type="checkbox" onclick="myFunction('conf_pass')">  show confirm password
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
</div>

<script>
function myFunction(a) {
    let p = document.getElementById(a);
    if (p.type === "password") {
    p.type = "text";
    } else {
    p.type = "password";
    }
}
</script>
