<?

namespace models;

use base\BaseForm;
use library\Auth;
use library\Db;


class LoginForm extends BaseForm
{
	public $login;
	public $password;

	//правила для валидации
	public function getRules()
	{
		return [
			'login'    => ['required', 'email'],
			'password' => ['required']
		];
	}


	public function doLogin()
	{
		$password = $this->password;
		$sql = "SELECT * FROM user WHERE login='{$this->login}' and password='{$password}'";

		$result = $this->_db->sendQuery($sql);
		if ($result->num_rows > 0) {
			$user = $result->fetch_assoc();
			Auth::login($user['id'], $user['role']);
			return true;
		} else {
			$this->_errors['login'] =  'error login';
			return false;
		}
	}
}