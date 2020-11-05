<?
$model = $data['model'];
$errors = $model->getErrors();
if (!empty($errors)) {
	echo "<pre>";
	print_r($errors);
	echo "</pre>";
}
?>
<h1>login</h1>
<form method="POST">
	<p><input type="text" name="login" placeholder="login"></p>
	<p><input type="text" name="password" placeholder="password"></p>
	<button>login</button>
</form>