<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Новая страница");
?>

<?
/*

	xDebug

	1) модуль xDebug  -  Это расширение , если его нет, нужно устанавливать из https://xdebug.org/ ( для своей версии php и для версии Сервера )

	2) И настраиваем php.ini
	https://dev.1c-bitrix.ru/learning/course/index.php?COURSE_ID=37&LESSON_ID=3421
	/etc/php.d/15-xdebug.ini
			zend_extension = xdebug.so
			xdebug.remote_enable=1
			xdebug.remote_host=127.0.0.1
			xdebug.remote_port=9000
			xdebug.remote_autostart=1

	service httpd restart  - перезапустить apache

	!!! https://qna.habr.com/q/403390
			(https://gotterdemarung.wordpress.com/2014/02/10/enabling-xdebug-in-htaccess/ - правки в htaccess)
			<If "%{REMOTE_ADDR} == '176.121.179.243'">
			  php_flag xdebug.remote_enable 1
			</If>
			пробрасываем порт (можно через putty)
			ssh -R 9000:localhost:9000 bitrix@uplab.digital
			ssh -R 9000:localhost:9000 bitrix@192.168.0.101


	3) Настраиваем phpstorm
		1) Settings → Languages & Frameworks → PHP
		2) добавляем php( на php.exe ) - https://take.ms/Z7iK3 (если нужно, можно на удаленный кинуть)
		3) влкадка Debug
			секция xdebug - порт такой же как выше 9000
						   Force - 2 галочки убираем (останавливаться ли на первой строке)
						   Can accept external connections - ставим галочку

			влкадка DBGP Proxy - заполняем данными выше ( https://skr.sh/s4Uwli06PtS )


	4) https://skr.sh/s4UcTFBwy3y  - настраиваем сервер (uplab.digital  на 443)


	5) устанавливаем расширение хром
			https://chrome.google.com/webstore/detail/xdebug-helper/eadndfjplgieldjbigjakmdgkmoaaaoc

	6) запускаем прослушка в phpstorm , потом в браузере.


 */
?>
<?
echo '1';
echo '2';
echo '3';
echo '44';
echo "<pre>";
var_dump(['adsf','dd']);
echo "</pre>";

phpinfo();

?>


<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>