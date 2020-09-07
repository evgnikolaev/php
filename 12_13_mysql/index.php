<?
/*
 	MYSQL.

	phpmyadmin - удобный интерфейс, чтобы из консоли не работать.

	По умолчанию всегда будут 2 служебные базы (их не трогаем)
		information_schema
		performance_schema

	1) создаем БД в кодировке - utf8_general_ci.
		Под каждую сущность создаем таблицу.

		--- СВОЙСТВА СТОЛБЦА ТАБЛИЦЫ ---
			имя 			- название столбца
			тип 			- тип столбца
			длина/значение 	- можем ограничить по длине значение столбца
			по умолчанию 	- значение по умолчанию для столбца, если не задали значение
			сравнение		- можем отдельно задать кодировку для столбца, например китайское слово
			атрибуты		- 	binary  						- бинарное значение
						  	unsigned 						- положительное
							unsugned zerofil 				- положительное с лидирующим нулем (01,02 ...)
							on update current timestamp		- текущий timestamp при создании по умолчанию
			null 			- можно ли в столбец сохранить null (обычно для необязательных полей, если не передали, то будет null)
			индекс			- облегчают поиск по базе.
							БД создает отдельное хранилище, и ищется по нему.
							INDEX - простой индекс
							PRIMARY - primary key
							UNIQUE - уникальный

			AI				- столбец автоинкрементный
			комментарии		- комментарий для столбца таблицы
			виртуальность	    - не трогаем
			MIME-тип		- дополнительно, для типа столбца BLOB - для хранения целых файлов. Но так никто не делает в вебе, в других приложениях может быть нужно.


		--- СВОЙСТВА САМОЙ ТАБЛИЦЫ ---:
			Комментарий к таблице.
			Сравнение  		- можно задать кодировку для все таблицы
			Тип таблиц 		- 	InnoDB - быстро искать, добавлять. Отдача медленнее чем MyISAM. Используем его.
					 			MyISAM - рассчитан на максимальную отдачу данных. Добавление, удаление изменение долгое. Используют для проектов как справочники. Один раз внесли, дальше просто отдача данных. Не поддерживает транзакции, индекс, ключи. Устарел.
			Определение разделов PARTITION - сюда не лезем.




		Сущность post
		имя			тип			Длина/Значение	По умолчанию		        Атрибуты						 Индекс			AI
		id			int																				PRIMARY			ok
		title		varchar			255																UNIQUE
		pub_date	timestamp					current_timestamp	onupdate_current_timestamp
		content		text





		2) --- SQL запросы ---
		Запросы DDD - запросы для работы  с данными


		Выборка
		SELECT `поля таблицы` FROM `таблица` WHERE `предикат - наборы условий к каждой записи`   - кавычки можно ставить, можно и нет
		SELECT title, content FROM `post` WHERE id >=0
												id = 1
												id 	!= 1
												id IS NULL     			(проверка на NULL)
												id IS NOT NULL
												id BETWEEN 1 and 10 	(между)
												id IN (1,15,25)			(любое из)
												id NOT IN (1,15,25)
												title LIKE '%мой%'		(содержит "мой")
												title NOT LIKE '%мой%'
												title NOT LIKE '%мой%' AND pub_date>564245  (сложное удаление)


 		Вставка
		INSERT INTO `таблица` (`поля`) VALUES (`значения`) - неиспользуемые поля можно не писать
		Можно добавить несколько записей за раз
		INSERT INTO `post`( `title`,`content`) VALUES ('второй пост','контент2'), ('третий пост','контент3')


 		Замена
		!!!! если не указать условие , погубиться вся таблица !!!!
		UPDATE `таблица` SET `поля` WHERE `предикат - наборы условий к каждой записи`
		UPDATE `post` SET `title`='title11' WHERE `id`=1


		Удаление
		!!!! если не указать условие , погубиться вся таблица !!!!
		DELETE FROM `таблица` WHERE `предикат - наборы условий к каждой записи`
		DELETE FROM `post` WHERE id=1




		3) --- ф-ии для работы с БД ---

			1) $link = @mysqli_connect('host','user','password','db_name') - соединение с БД, вернет ресурс или false.
																		     @ - отключает показ ошибок для ф-ии

				mysqli_connect_errno() - код ошибки
				mysqli_connect_error() - сообщение ошибки

				mysqli_set_charset($link,'utf8') - если проблема с кракозябрами, устанавливаем кодировку соединения


			2) $res = mysqli_query($link, 'sql') - выполнить запрос
													вернет 	при select - mysqli_result
													при update/insert/delete - id записи
													при ошибка в запросе - false

				$res->num_rows - можно проверить, не пустой ли запрос


				mysqli_errno($link) - код ошибки в запросе
				mysqli_error($link) - сообщение ошибки в запросе

			3) 	mysqli_fetch_all($res,MYSQLI_ASSOC) - получить сразу в массив, не всегда удбно
				mysqli_fetch_assoc($res) - получить в массив из строки таблицы

				while ($raw = mysqli_fetch_assoc($res)) {
					var_dump($raw);
				}


			4) mysqli_close($link)  - закрыть БД, лучше самому закрыть соединение, самому следить за этим, не ждать пока php закроет.






 */

$settings = [
	'host' => 'localhost',
	'user' => 'root',
	'password' => 'root',
	'db_name' => 'web15'
];

$link = mysqli_connect($settings['host'], $settings['user'], $settings['password'], $settings['db_name']);
if (!$link) {
	die('DB connection error! Error code - ' . mysqli_connect_errno() . ' . Error message - ' . mysqli_connect_error());
}
mysqli_set_charset($link, 'utf8');

$sql = 'SELECT id,title,content,pubdate FROM post';
$res = mysqli_query($link, $sql);
if (!$res) {
	die(mysqli_errno($link) . ' --- ' . mysqli_error($link));
}

if ($res->num_rows > 0) {
	while ($raw = mysqli_fetch_assoc($res)) {
		echo "<pre>";
		var_dump($raw);
		echo "<pre>";
	}
} else {
	echo 'empty set';
}

//2 запрос
$sql = "INSERT INTO post (title, content) VALUES ('php title','php content')";
$res = mysqli_query($link, $sql);
if ($res) {
	echo 'Данные успешно добавлены';
}else{
	die(mysqli_errno($link) . ' --- ' . mysqli_error($link));
}

mysqli_close($link);