<?
session_start();


/** Получить всех пользователей
 * @return array
 */
function getAllUser()
{
	$users = [];
	if (file_exists('user.txt')) {
		$t = file_get_contents('user.txt');
		$t2 = explode(';', $t);

		foreach ($t2 as $userString) {
			$users[] = explode(':', $userString);
		}
	}

	return $users;
}


/** Существует польщователь?
 * @param $login
 * @param $password
 */
function issetUser($login, $password)
{
	$allUsers = getAllUser();
	if (!empty($allUsers)) {
		foreach ($allUsers as $user) {
			if ($login === $user[0] and $password === $user[1]) {
				$_SESSION['user'] = $user[0];
				return true;
			}
		}
	}

	return false;
}


/** Зарегистрирован пользователь?
 * @return bool
 */
function is_guest()
{
	if (!empty($_SESSION['user'])) {
		return false;
	}
	return true;
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' and !empty($_POST['login'])) {
	//запомнить меня
	if (isset($_POST['remember'])) {
		setcookie('hash', 'asadasdasdasdasd', time() + 60*20);
	}
	if (issetUser($_POST['login'], $_POST['password'])) {
		header('Location:index.php');
	} else {
		echo 'пользователь не найден';
	}
}

?>

<? if (is_guest()) { ?>
	<form action="" method="post">
		<p>Login <input type="text" name="login"></p>
		<p>Password <input type="text" name="password"></p>
		<p><input type="checkbox" name="rememver">Remember me</p>
		<button>login</button>
	</form>
<? } else { ?>
	<a href="logout.php">Выход</a>
<? } ?>
