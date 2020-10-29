<?
/* @var  $formErrors */
?>

<h1>Registration</h1>

<form action="" method="POST">
	<input type="text" name="login" value="<?= (isset($_POST['login'])) ? $_POST['login'] : ''; ?>" placeholder="login">
	<input type="email" name="email" value="<?= (isset($_POST['email'])) ? $_POST['email'] : ''; ?>" placeholder="email">
	<input type="password" name="password" placeholder="password">

	<?
	if ((isset($data['errors']['login']))) {
		echo '<pre>';
		var_dump($data['errors']);
		echo '</pre>';
	} ?>

	<button>submit</button>
</form>