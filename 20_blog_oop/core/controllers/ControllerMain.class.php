<?

namespace controllers;

use base\Controller;
use library\Auth;
use library\Db;
use library\HttpException;
use library\Request;
use models\LoginForm;
use models\RegisterForm;

class ControllerMain extends Controller
{

	public function actionIndex()
	{
		echo 'actionIndex';
	}


	public function actionLogin()
	{
		if (Auth::isGuest()) {
			$model = new LoginForm();
			if (Request::isPost()) {
				if ($model->load(Request::getPost()) and $model->validate()) {
					if ($model->doLogin()) {
						header('Location: /20_blog_oop?login=Y');
					}
				}
			}

			$this->_view->setTitle('login action title');
			$this->_view->render('login', ['model' => $model]);
		} else {
			throw new HttpException('forbit', 403);
		}
	}


	public function actionLogout()
	{
		if (!Auth::isGuest()) {
			Auth::logout();
			header('Location: /20_blog_oop?logout=Y');
		} else {
			throw new HttpException('forbitten', 403);
		}
	}


	public function actionRegister()
	{
		if (Auth::isGuest()) {
			$model = new RegisterForm();
			if (Request::isPost()) {
				if ($model->load(Request::getPost()) and $model->validate()) {
					if ($model->doRegister()) {
						header('Location: /20_blog_oop?register=Y');
					}
				}
			}

			$this->_view->render('registration', ['model' => $model]);
		} else {
			throw new HttpException('forbitten', 403);
		}
	}


}