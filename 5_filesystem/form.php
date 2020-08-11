<? /*
		2) ПОЛУЧАЕМ ДАННЫЕ ОТ ПОЛЬЗОВАТЕЛЯ
		<form> - атрибуты action - по умолчанию уходит на тот же путь
        $_GET - вернет [name => value]

*/ ?>
<?
function checkData()
{
	if (!empty($_GET['userName']) && !empty($_GET['content'])) {
		return true;
	}
	return false;
}


/**  Сохраняет данные в файл
 * @param string $author
 * @param string $content
 */
function saveComment($author, $content)
{
	$res = file_put_contents('files/form.txt', $author . ':' . $content . ':' . time() . ';', FILE_APPEND);

	if ($res === false) {
		echo 'Запись не удалась';
	} else {
		header('Location:form.php?mes=success');
	}
}

if ($_GET['formName'] === 'formValue') {
	if (checkData()) {
		saveComment($_GET['userName'], $_GET['content']);
	} else {
		echo 'Все поля обязательны';
	}
}

if ($_GET['mes'] === 'success') {
	echo '<p>В файл успешно записалось</p>';
}
?>

<form>
	<p><input type="text" name="userName"></p>
	<p><textarea name="content"></textarea></p>
	<p><input type="hidden" name="formHidden" value="formHiddenValue">
	</p> <? /* Чтобы узнать, что отправила эта форма */ ?>
	<button name="formName" value="formValue">submit</button>
	<? /* Или так , Чтобы узнать, что отправила эта форма */ ?>
</form>
