<?php include('header.php'); ?>
<title>Forget Password</title>
<h1 class="d-flex justify-content-center">Forget Password</h1>
<div class="form-group d-flex justify-content-center">
    <form method="POST">
        <div>
            <label>
                Email: <input class="form-control" placeholder="Email" type="text" name="email">
            </label>
        </div>
        <span>
            <input type="submit" class="btn btn-warning" name="forget_pass" value="Reset Password">
        </span>
    </form>
</div>
