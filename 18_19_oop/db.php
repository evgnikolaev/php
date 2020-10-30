<?
//singleton
//создаем одно подключение, чтобы не плодить (одно что-то на протяжении всего кода)
//если бы мы не использовали класс, нам бы пришлось также держать соединение например в глобальной переменной

class DB
{
	protected $config = [
		'host'     => 'localhost',
		'user'     => 'root',
		'password' => '',
		'db_name'  => 'blog_web15'
	];
	protected static $link = null;
	private $db;


	public function __construct()
	{
		$this->db = new mysqli(
			$this->config['host'],
			$this->config['user'],
			$this->config['password'],
			$this->config['db_name']
		);
	}

	public static function getLink()
	{
		if (is_null(self::$link)) {
			self::$link = new self();
		}
		return self::$link;
	}


	public function __destruct()
	{
		$this->db->close();
	}
}

$link = DB::getLink();

echo "<pre>";
var_dump(DB::getLink());
echo "</pre>";