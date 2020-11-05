<? /*
Один класс - один файл, имя класса соответствует имени файла!!
!!! В линуксе имена файла чувствитльны к регистру !!!
!!! \controllers\ControllerMain - пути в namespace должны быть такие как в струтукре файлов, для правильной автозагрузки классов !!!

 www.site.com/контроллер/экшен/
					контроллер - объект
                    экшен - метод обекта

*/
$_GET['url'] = str_replace('20_blog_oop/', '', $_GET['url']);
session_start();


function __autoload($className)
{
	$fileName = 'core/' . str_replace('\\', '/', $className) . '.class.php';
	if (!file_exists($fileName)) {
		throw new Exception($className . ' class not found');
	}
	require_once $fileName;
}

//роутинг   -   www.site.com/контроллер/экшен/
$controllerName = \library\Url::getSegment(0);
$actionName = \library\Url::getSegment(1);
if (is_null($controllerName)) {
	$controller = 'controllers\ControllerMain';
} else {
	$controller = 'controllers\Controller' . ucfirst($controllerName);
}

if (is_null($actionName)) {
	$action = 'actionIndex';
} else {
	$action = 'action' . ucfirst($actionName);
}


try {
	$fileName = 'core/' . str_replace('\\', '/', $controller) . '.class.php';
	if (!file_exists($fileName)) {
		throw new \library\HttpException('Not found', 404);
	}
	$controller = new $controller();

	if (!method_exists($controller, $action)) {
		throw new \library\HttpException('Not found', 404);
	}
	$controller->$action();


//можно при возникновении разных исключений, делать разные вещи
} catch (\library\HttpException $e) {
	header('HTTP/1.1 ' . $e->getCode() . ' ' . $e->getMessage()); //кидаем 404
	die();
} catch (Exception $e) {
	echo $e->getMessage(); //просто выводим сообщение
}