<? /*
Абстрактные классы - когда используются группы примерно одинаковых классов.
Это как эскиз (по ним будет чертеж)
Для проектировки, обязываем описать далее при наследовании.

Интерфейс (очень похож на абстрактный класс) как несколько эскизов.
*/

abstract class MyClass
{
	abstract function run($a, $v);

	function go()
	{

	}
}

interface MyInterface
{
	 function goBack();
}


class MyClass2 extends MyClass implements MyInterface
{
	public function run($a, $v)
	{
		// TODO: Implement run() method.
	}

	 function goBack()
	{
		// TODO: Implement goBack() method.
	}

}