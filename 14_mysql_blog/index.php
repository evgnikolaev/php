<?
/*

	--- Структура папок: ---
		index.php - точка входа
		assets	- html, js, css (ресурсы)
		core	- ядро системы (все необходимое для работы приложения)


	--- url (ЧПУ) ---
		будем уходить от    mysite/index.php?catalog=asd
		к url вида         mysite/catalog/asd
		для этого создаем .htaccess (правила для веб сервера)


	---  Модель MVC ---
		В url будем всегда писать имя контроллеара, после имя action   -  /controller/action/.
		Контроллер - файлик, в нем action - функция, вызывается из файлика.

		Есть 2-ой способ, папки - контроллеры, файлы - action-ы.

		Задача контроллера сгрупировать, чтобы не было каши.

		Одна точка входа - index.php . В ней делаем роутинг.



 */

$_GET['url'] = str_replace('14_mysql_blog/', '', $_GET['url']);
$url = $_GET['url'];
$urlSegments = explode('/', $url);

//по умолчанию
$cntrName = (empty($urlSegments[0])) ? 'main' : $urlSegments[0];
$actionName = (empty($urlSegments[1])) ? 'action_index' : 'action_' . $urlSegments[1];


//подключаем контроллер и action
if (file_exists('core/controllers/' . $cntrName . '.php')) {
	require_once 'core/controllers/' . $cntrName . '.php';

	if (function_exists($actionName)) {
		$actionName();
	} else {
		echo '404 page';
	}
} else {
	echo '404 page';
}
