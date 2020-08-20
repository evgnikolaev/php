<?
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$data = file('user.txt');

	foreach ($data as $d) {
		$us = explode(':', $d);
		$us[1] = substr($us[1], 0, -1);
		if ($us[0] == $_POST['login'] && $us[1] == $_POST['password']) {
			$_SESSION['auth_user'] = true;
			header('Location:session.php');
		}
	}
}
?>
<a href="session.php">секретный контент</a>
<form action="" method="post">
	<input type="text" name="login" placeholder="login"> <input type="text" name="password" placeholder="password">
	<button>login</button>
</form>