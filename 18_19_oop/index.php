<? /*
Класс - наподобие чертежа.
Ранее мы работали на основе алгоритмов, сейчас работаем на уровне взаимодействия объектов.

Свойства - любой тип (не используем выражения)

модификаторы:
public - доступ отовсюду.
protected - извне не получть , может получить владелец и наследник
private - кроме владельца доступа не получит


*/

class Car
{
	protected $color = 1.4;
	protected $engine;
	protected $type;
	protected $name;
	private $winCode;
	const MYCONST = 'asdas';

	public static function getEngine()
	{
		//this десь null, недоступен
		echo 'Hello from static';
	}


	public function move($distance)
	{
		echo "echo Car " . $this->name . "проехала -" . $distance;
	}

	//при создании объекта
	public function __construct($color, $type)
	{
		$this->color = $color;
		$this->type = $type;
		$this->winCode = 'win';
	}

	//при удалении объекта
	public function __destruct()
	{
		// в тот момент когда на объек уже ничего не ссылается
		// обычно здесь закрывают соединения с бд, файлы ...
	}

}


//наследуются все методы и свойства (public и private)
// Унаследоваться можно только от одного класса
// Поэтому нужно строить правильную иерархию
class Track extends Car
{
	private $winCode = 6;
	protected $a;

	public function __construct($color, $type, $a = 8)
	{
		$this->a = $a;
		parent::__construct($color, $type);//вызов родительского метода
	}

	public function printWin()
	{
		//echo self::MYCONST;//вывод константы
		//echo $this->winCode;
	}
}


$car1 = new Car('red', 5);
$car12 = new Track('red', 5);
Car::getEngine();