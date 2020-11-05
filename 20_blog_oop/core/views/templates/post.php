<?
$model = $data['model'];
$errors = $model->getErrors();
if (!empty($errors)) {
	echo "<pre>";
	print_r($errors);
	echo "</pre>";
}
?>
<h1>post</h1>
<form method="POST">
	<p>
		<input type="text" name="title" placeholder="title" value="<?= ($model->title) ? $model->title : ''; ?>">
	</p>
	<p><textarea name="content" >
			<?= ($model->content) ? $model->content : ''; ?>
		</textarea></p>
	<button>registration</button>
</form>