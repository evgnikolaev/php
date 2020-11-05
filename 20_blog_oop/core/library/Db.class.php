<?
namespace library;
/*
	сущность для работы  с  БД .
	Определяеся что для этого нужно:
		- получить соединение
		- отправка запроса
*/


class Db
{
	protected $config = [
		'host'     => 'localhost',
		'user'     => 'root',
		'password' => '',
		'db_name'  => 'blog_web15'
	];

	private static $_db = null;
	private $_link;


	public function sendQuery($sql)
	{
		$result = $this->_link->query($sql);
		if (!$result) {
			throw new \Exception($this->_link->error);
		}
		return $result;
	}


	public function getSaveData($data)
	{
		return $this->_link->escape_string($data);
	}


	static function getDb()
	{
		if (is_null(self::$_db)) {
			self::$_db = new self();
		}
		return self::$_db;
	}

	public function __construct()
	{
		$this->_link = @new \mysqli(
			$this->config['host'],
			$this->config['user'],
			$this->config['password'],
			$this->config['db_name']
		);
		if ($this->_link->connect_error) {
			throw new \Exception($this->_link->connect_error);
		}
		$this->_link->set_charset('utf-8');
	}


	public function getLastInsertId()
	{
		return $this->_link->insert_id;
	}

}