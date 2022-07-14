<?php /** @var \App\Data\UserDTO|null $data */ ?>
<?php if (isset($_SESSION['success'])): ?> <p
        style="color : green"> <?php echo($_SESSION['success']); ?> </p> <?php unset($_SESSION['success']); endif; ?>
<?php foreach ($errors as $error): ?>
    <p style="color: red"><?= $error ?></p>
<?php endforeach; ?>
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
        crossorigin="anonymous"></script>
<h1 class="d-flex justify-content-center">Login</h1>
<div class="form-group d-flex justify-content-center">
    <form method="POST">
        <div>
            <label>
                Username/Email: <input  class="form-control"  placeholder="Username/Email" type="text" name="data">
            </label>
        </div>

        <div>
            <label>
                Password: <input type="password" class="form-control" placeholder="Password" value="" name="password">
            </label>
        </div>

        <span>
                <input type="submit" class="btn btn-primary" name="login" value="Sing In">
        </span>
        <span>
            <a class="btn btn-success" href="register.php" role="button">Register</a>
        </span>
    </form>
</div>
