<?
function action_index()
{
	if (is_auth()) {
		echo "action_index";
	} else {
		echo "action_index for guest";
	}
}


function action_contacts()
{
	echo "action_contacts";
}

/*
    Регистрация
*/
function action_registration()
{
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {

		//! перед тем как проверить на валидатор, нужно отфильтровать данные !
		$formData = [
			'login'    => getSaveData(htmlspecialchars(trim($_POST['login']))),
			'password' => getSaveData(trim($_POST['password'])),
			'email'    => getSaveData(trim($_POST['email']))
		];

		//набор правил
		$rules = [
			'login'    => ['required', 'login'],
			'password' => ['required'],
			'email'    => ['required', 'email'],
		];

		//валидируем
		$errors = validateForm($rules, $formData);
		if (empty($errors)) {
			$formData['password'] = md5($formData['password']);

			//перед добавление проверяем, есть там или нет
			$sql = "SELECT id FROM `user` WHERE login='{$formData['login']}' or email='{$formData['email']}'";
			$res = selectData($sql);
			if ($res->num_rows === 0) {
				//добавляем в БД
				$sql = "INSERT INTO `user`(`login`, `password`, `email`) VALUES ('{$formData['login']}','{$formData['password']}','{$formData['email']}')";
				if (insertUpdateDelete($sql)) {
					header('Location: /14_mysql_blog/main/successReg');
				}
			} else {
				echo 'login or email isset';
			}
		} else {
			echo 'Ошибки валидации';
			echo "<pre>";
			print_r($errors);
			echo "</pre>";
		}
	}


	renderView('registration', $errors);
}


function action_successReg()
{
	echo "Вы успешно зарегистрированы";
}


/*
    Авторизация
*/
function action_auth()
{
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$formData = [
			'login'    => getSaveData(htmlspecialchars(trim($_POST['login']))),
			'password' => getSaveData(trim($_POST['password'])),
		];
		$formData['password'] = md5($formData['password']);

		$sql = "SELECT id FROM `user` WHERE login='{$formData['login']}' and password='{$formData['password']}'";
		$res = selectData($sql);
		if ($res->num_rows === 0) {
			echo 'incorrect login or password';
		} else {
			$_SESSION['user'] = mysqli_fetch_assoc($res);
			header('Location: /14_mysql_blog/');
		}
	}
	renderView('login');
}

function action_logout()
{
	session_unset();
	session_destroy();
}


























