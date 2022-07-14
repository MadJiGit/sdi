<?php /** @var \App\Data\UserDTO|null $data */ ?>

<?php /** @var array $errors|null */
foreach ($errors as $error): ?>
	<p style="color: red"><?= $error ?></p>
<?php endforeach; ?>
<script src="https://kit.fontawesome.com/45a931535c.js" crossorigin="anonymous"></script>

<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<h1 class="d-flex justify-content-center">Reset Password</h1>
<div class="form-group d-flex justify-content-center">
	<form method="POST">
		<div>
			<label>
				Username: <input class="form-control"  placeholder="Username" type="text" name="username">
			</label>
        </div>
		<div>
			<label>
				Password: <input class="form-control"  placeholder="Password" type="password" name="password">
			</label>
		</div>

		<div>
			<label>
				Confirm Password: <input class="form-control"  placeholder="Password" type="password" name="confirm_password">
			</label>
		</div>
		<span>
<!--            <a class="btn btn-warning" href="reset_pass" role="button">Reset Password</a>-->
            <input type="submit" class="btn btn-warning" name="reset_pass" value="Reset Password">
    </span>
        <span>
            <a class="btn btn-success" href="login.php" role="button">Log In</a>
    </span>
	</form>
