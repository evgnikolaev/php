<?
/*

	xDebug

	1) модуль xDebug  -  Это расширение , если его нет, нужно устанавливать из https://xdebug.org/ ( для своей версии php и для версии Сервера )

	2) И настраиваем php.ini
			zend_extension 					= "%sprogdir%/modules/php/%phpdriver%/ext/php_xdebug.dll"   (откуда взять модуль)
			xdebug.remote_autostart         = on                                                        (удаленный автозапуск)
			xdebug.remote_enable            = on                                                        (удаленный доступ)
			xdebug.remote_handler           = "dbgp"                                                    (обработчик)
			xdebug.remote_host              = "localhost"                                               (где)
			xdebug.remote_port              = 9001                                                      (порт, на котором отслеживаем)
			xdebug.remote_mode              = "req"                                                     (режим)
			xdebug.idekey              		= "PHPSTORM"                                                (чтобы перехватить на phpstorm)

	3) Настраиваем phpstorm
		1) Settings → Languages & Frameworks → PHP
		2) добавляем php( на php.exe ) - https://take.ms/Z7iK3
		3) влкадка Debug
			секция xdebug - порт такой же как выше 9001
						   Force - 2 галочки убираем (останавливаться ли на первой строке)
						   Can accept external connections - ставим галочку

			влкадка DBGP Proxy - заполняем данными выше ( если php запускается на другом порте (не 80), нужно дописать например localhost:8080 )


	4) устанавливаем расширение хром
			https://chrome.google.com/webstore/detail/xdebug-helper/eadndfjplgieldjbigjakmdgkmoaaaoc

	5) запускаем прослушка в phpstorm , потом в браузере.

	6) Дополнительно http://xandeadx.ru/blog/raznoe/878


 */
?>
<?
echo '1';
echo '2';
echo '3';
echo '4';
phpinfo();