<?
/* @var  $formErrors */
?>

<h1>Login</h1>

<form action="" method="POST">
	<input type="text" name="login" value="<?= (isset($_POST['login'])) ? $_POST['login'] : ''; ?>" placeholder="login">
	<input type="password" name="password" placeholder="password">

	<?
	if ((isset($formErrors['login']))) {
		echo '<pre>';
		var_dump($formErrors);
		echo '</pre>';
	} ?>

	<button>login</button>
</form>