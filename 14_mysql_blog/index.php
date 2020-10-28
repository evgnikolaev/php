<?
$_GET['url'] = str_replace('14_mysql_blog/', '', $_GET['url']);


/*

	--- Структура папок: ---
		index.php - точка входа
		assets	- html, js, css (ресурсы)
		core	- ядро системы (все необходимое для работы приложения)
			library - библотека полезных ф-ий
			controllers
			views
			models


	--- url (ЧПУ) ---
		будем уходить от    mysite/index.php?catalog=asd
		к url вида         mysite/catalog/asd
		для этого создаем .htaccess (правила для веб сервера)


		Модель MVC
		В url будем всегда писать имя контроллера, после имя action   -  /controller/action/.
		Контроллер - файлик, в нем action - функция, вызывается из файлика.

		Есть 2-ой способ, папки - контроллеры, файлы - action-ы.

		Задача контроллера сгрупировать, чтобы не было каши.

		Одна точка входа - index.php . В ней делаем роутинг.




Порядок работы:
1) сперва сделали роутинг
2) занялись регистрацией пользователя

		1) страница
				форма
		2) обработчик формы
			проверить данные
			создать запись в бд
			если все хорошо, что-то сделать
			если плохо, что-то сделать

		При создании комментария , поста - будет такая же логика.

		Чтобы не копипастить везде обработчик, Нужно делать по принципу MVC!!!!
		model - работа с данными!!
		controller - обработка запросов. (/controller/main.php - контроллер, в зависимости от url будет запущена нужная функция)
		view - просто вывод.

		поэтому создаем контроллер registration, в ней ф-ия , после отправки формы данные опять придут на контроллер registration,
		и в ней вызовется другая ф-ия, которая запросит данные из модели, и что- то с ниим сделает.

		То есть обработчик не должен и проверять, и выводить результат, по сути он должен только завалидировать форму.

 */
session_start();
require_once 'core/library/main.php';
require_once 'core/library/validator.php';
require_once 'core/library/db.php';
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
		show404page();
	}
} else {
	show404page();
}