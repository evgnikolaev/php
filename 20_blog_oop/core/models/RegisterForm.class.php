<?
namespace models;

use base\BaseForm;
use library\Auth;

class RegisterForm extends BaseForm
{

	public $login;
	public $password;
	public $password_confirm;
	protected $_tableName = 'user';


	//правила для валидации
	public function getRules()
	{
		return [
			'login'    => ['required', 'email', 'unique'],
			'password' => ['required', 'confirm']
		];
	}

	public function doRegister()
	{
		$sql = "INSERT INTO user (login, password, email) VALUES ('{$this->login}','$this->password','test" . time() . "@mail.ru')";
		$res = $this->_db->sendQuery($sql);
		if (!$res) {
			$this->_errors['register_model'] = 'Error register model';
			return false;
		}


		$id = $this->_db->getLastInsertId();
		$role = 'user';
		Auth::login($id, $role);


		return true;

	}
}