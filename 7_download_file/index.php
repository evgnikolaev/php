<? /*

 		!!!!!! 8-ое видео идентично не смотрел !!!!!!!!

 
        1) ЗАГРУЗКА ФАЙЛОВ НА СЕРВЕР


		php.ini - файл глобальной конфигурации php, здесь все настройки
		на хостинге к нему доступа нет (будет, только если будет виртуальный сервер - когда сами все ставим)


		phpinfo() - инфо о php, любая служебная информация
			local value - значение в php.ini
			master value - значение переопределенное


        Директивы в для загрузки (эти ограничения нужны для безопасности)
	        file_uploads            - on
	        post_max_size           - значение рамеров файлов, которое можно загружать методом POST
	        upload_max_filesize     - сколько за раз можно загрузить(должна быть меньшу post_max_size)
			upload_tmp_dir          - файл отправляется на сервер, и отправляется на temp директорию, пока скрипт работает(что-то с этим файлом мы можем делать), вконце этот файл удаляется
            max_input_time          - если мы пытаемся сделать чего то много, максимальное время на обработку входящих данных
            max_input_vars          - длина POST или GET
            max_file_uploads        - кол-во файлов, которое можно загрузить за раз одновременно


 		под linux ставим права на папку
 			chmod -R 777 upload 	- максимальные права на папку upload рекурсивно (лучше ставить права 775 или 755)
 			sudo ... 				- выполнить от пользователя команду


		Форма

             <form action="" method="POST" enctype="multipart/form-data">
					<input type="file" name="picture">
					<button>upload</button>
			 </form>


	        enctype="multipart/form-data" - без этого атрибута файлы не отправятся на сервер, отправятся только текстовые данные
			$_FILES - хранится инфо о файле, данные попадут не в POST, а сюда
					name        - оригиналоьное имя
					type        - тип
					tmp_name    - временная папка где она лежит, в конце скрипта удаляется
					error       - ошибка https://www.php.net/manual/ru/features.file-upload.errors.php , если 0 - то загрузилось
					size        - размер (можно проверять на размер загружаемого файла)


 			move_uploaded_file()  - Для созранения файла,  проверяет действительно ли файл был загружен по http-протоколу POST и т.д.!!!
 									Для созранения нелья использовать ф-ии copy() , rename()  -  это дыра в безопасности!!!

 			pathinfo('путь')       - инфо о файле(расширение, имя) Не проверяют файл на корректность, лучше использовать его



			 Пример с галереей - папка gallery
 				 https://github.com/toddmotto/superbox
					 index.php - вывод галереи
					 upload-picture.php - загрузка фоток для галереи




*/ ?><?

echo "<pre>";
print_r($_FILES);
echo "</pre>";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	if ($_FILES['picture']['error'] == 0) {
		$tmpName = $_FILES['picture']['tmp_name'];

		// copy()  для перемещения не использовать - это дыра в безопасности
		//if (copy($tmpName, 'upload/pic.jpg')) {
		//	echo 'file was saved';
		//} else {
		//	echo 'not saved file';
		//}


		// Иногда на высоконагруженных проектах делают папки день, месяц, год , чтобы все не лежало в одной папке - долго ситается когда в одной папке.
		if (move_uploaded_file($tmpName, 'upload/' . time() . '.' . pathinfo($_FILES['picture']['name'])['extension'])) {
			echo 'file was saved';
		} else {
			echo 'not saved file';
		}


	} else {
		echo 'Error - ' . $_FILES['picture']['error'];
	}
}
?>

<form action="" method="POST" enctype="multipart/form-data">
	<? /*<input type="hidden" name="MAX_FILE_SIZE" value="2048">*/ ?> <? /* максимальный размер в байтах  - не безопасный способ  */ ?>
	<input type="file" name="picture">
	<button>upload</button>
</form>
