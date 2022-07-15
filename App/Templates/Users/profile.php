<?php include('header.php'); ?>
<title>Hello, <?php echo($data->getUsername()) ?></title>
<h1 class="d-flex justify-content-center">Hello, <?php echo($data->getUsername()) ?></h1>
<div class="form-group d-flex justify-content-center">
    <form method="POST">
        <span>
            <a class="btn btn-success" href="../../../login.php" role="button">Back to Login</a>
        </span>
        <span>
            <a class="btn btn-warning" href="../../../logout.php" role="button">Logout</a>
        </span>
    </form>
</div>