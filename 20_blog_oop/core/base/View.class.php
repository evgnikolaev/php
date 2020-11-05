<?
namespace base;

class View
{
	public $basePath = __DIR__ . '/../views/templates/';
	protected $title;
	protected $seo = [];
	protected $css = [];
	protected $js = [];

	protected $_layout;

	public function setLayout($layout)
	{
		$this->_layout = __DIR__ . '/../views/layout/' . $layout . '.php';
	}

	public function render($tplName, $data)
	{
		include $this->_layout;
	}

	//геттеры сеттеры
	public function setTitle($str)
	{
		$this->title = $str;
	}

	public function getTitle()
	{
		return $this->title;
	}

	public function setCss($str)
	{
		$this->css = $str;
	}

	public function getCss()
	{
		return $this->css;
	}
}