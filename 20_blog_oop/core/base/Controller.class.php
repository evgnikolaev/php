<?

namespace base;

abstract class Controller
{
	protected $_view;

	abstract function actionIndex();


	public function __construct()
	{
		$this->_view = new View();
		$this->_view->setLayout('main');
	}
}
