<?
session_start();

function checkData()
{
	if (!empty($_POST['userName']) and !empty($_POST['content'])) {
		return true;
	}
	return false;
}


/** Сохранить коммент
 * @param $author
 * @param $content
 */
function saveComment($author, $content)
{
	$res = file_put_contents('content.txt', $author . ':' . $content . ':' . time() . ';', FILE_APPEND);
	if (!$res) {
		echo 'Запись не удалась';
	} else {
		header('Location:index.php?msg=success');
	}
}


/** Получить массив комментариев
 * @param $pathToFile
 */
function getAllComments($pathToFile)
{
	if (file_exists($pathToFile)) {
		$t = file_get_contents($pathToFile);
	}

	return explode(';', $t);
}


/**  Показать все комменты
 * @param $allComments
 */
function renderAllComment($allComments)
{
	foreach ($allComments as $comment) {
		if ($comment) {
			renderComment(explode(':', $comment));
		}
	}
}


/**  Показать коммент
 * @param $commentData
 */
function renderComment($commentData)
{
	$author = $commentData[0];
	$content = $commentData[1];
	$pubdate = date('d:m/Y H:i:s', $commentData[2]);
	include 'comment.tpl.php';
}


if ($_SERVER['REQUEST_METHOD'] == 'POST' and $_POST['formName'] == 'commentForm') {
	if (checkData()) {
		saveComment($_POST['userName'], $_POST['content']);
	} else {
		echo 'Все поля обязательны';
	}
}


/** Зарегистрирован пользователь?
 * @return bool
 */
function is_guest()
{
	//	 проверка - запомнить меня
	//	 по хорошему я должен был записать в user.txt параметр hash -  admin:123:значениеХеша
	//	 и здесь пробегаться по этому файлу и сравнивать хеш, если есть сразу логинить
	//		if(isset($_COOKIE['hash'])){
	//			.... проверки
	//		return false;
	//		}
	if (!empty($_SESSION['user'])) {
		return false;
	}
	return true;
}


?>

<? if (is_guest()) { ?>
	<p>Только авторизированные пользователи могут оставлять комментарии</p>
	<a href="login.php">Войти</a>
<? } else {
	if ($_GET['msg'] == 'success') { ?>
		<p>Коммент успешно добавлен</p>
	<? } ?>
	<a href="logout.php">Выход</a>
	<form action="" method="POST">
		<p>Автор <input type="text" name="userName"></p>
		<p>Комментарий <textarea name="content"></textarea></p>
		<p><input type="hidden" name="formName" value="commentForm"></p>
		<button>submit</button>
	</form>
<? } ?>

<div class="comment-blocks">
	<?
	$data = getAllComments('content.txt');
	if (!is_null($data)) {
		renderAllComment($data);
	}
	?>
</div>
