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


36 минут   todo


 */

echo "<pre>";
print_r($_GET);
echo "</pre>";