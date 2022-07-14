<?php /** @var \App\Data\UserDTO $data */ ?>
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
        crossorigin="anonymous"></script>
<h1 class="d-flex justify-content-center">Hello, <?php echo($data->getUsername()) ?></h1>
<div class="form-group d-flex justify-content-center">
    <form method="POST">
<span>
            <a class="btn btn-success" href="login.php" role="button">Back to Login</a>
        </span>
    </form>
</div>