<?

class DB
{

	private $storage = [
		'name' => 'vasya'
	];


	//при создании
	function __construct()
	{
		echo '__construct<br>';
	}


	//  !!!обезопашивает!!!
	//при обращении к свойству(которого нет или защищено)
	//например, не нужные динамические свойства не создали
	function __get($key)
	{
		if (isset($this->storage[$key])) {
			return $this->storage[$key];
		}
		return null;
	}


	//  !!!обезопашивает!!!
	//при обращении к свойству(которого нет или защищено)
	//например, не нужные динамические свойства не создали
	function __set($key, $value)
	{
		$this->storage[$key] = $value;
	}


	//при удалении
	function __destruct()
	{
		echo '__destruct<br>';
	}
}

$link = new DB();
echo $link->name = 'asd';