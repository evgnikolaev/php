<?
$model = $data['model'];
$errors = $model->getErrors();
if (!empty($errors)) {
	echo "<pre>";
	print_r($errors);
	echo "</pre>";
}
?>
<h1>registration</h1>
<form method="POST">
	<p>
		<input type="text" name="login" placeholder="login" value="<?= (\library\Request::isPost()) ? $model->login : ''; ?>">
	</p>
	<p><input type="text" name="password" placeholder="password"></p>
	<p><input type="text" name="password_confirm" placeholder="password_confirm"></p>
	<button>registration</button>
</form>