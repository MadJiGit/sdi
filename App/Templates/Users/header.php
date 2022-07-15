<?php /** @var \App\Data\UserDTO|null $data */ ?>
<?php if (isset($_SESSION['success'])): ?> <p
	style="color : green"> <?php echo($_SESSION['success']); ?> </p> <?php unset($_SESSION['success']); endif; ?>
<?php foreach ($errors as $error): ?>
	<p style="color: red"><?= $error ?></p>
<?php endforeach; ?>