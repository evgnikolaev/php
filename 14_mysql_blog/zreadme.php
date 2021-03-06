<?
/*

		БД "blog_web15"



		1) Сущность "USER"

		имя			тип			Длина/Значение		По умолчанию		Атрибуты	         Индекс			AI
		id			int																PRIMARY			ok
		login		varchar			50												UNIQUE
		password	varchar			250
		email		varchar			150												UNIQUE
		role		enum			'admin',			'user'
									'moderator',
									'user',



		2) Сущность "POST"

		имя				тип			Длина/Значение		По умолчанию	        	Атрибуты	 					Индекс			AI
		id				int																					PRIMARY			ok
		category_id		int																					INDEX
		author_id		int																					INDEX
		title			varchar			255																	UNIQUE
		content			text
		pubdate			timestamp					   current_timestamp	onupdate_current_timestamp




		3) Сущность "CATEGORY"

		имя				тип			Длина/Значение		По умолчанию		        Атрибуты	 					Индекс			AI
		id				int																					PRIMARY			ok
		title			varchar			255																	UNIQUE
		parent_id		int																					INDEX

		parent_id - будет использоваться для вложенности




		4) Сущность "COMMENT"

		имя				тип			Длина/Значение		По умолчанию		        Атрибуты	 					Индекс			AI
		id				int																					PRIMARY			ok
		post_id			int																					INDEX
		author_id		int																					INDEX
		content			text
		pubdate			timestamp					   current_timestamp	onupdate_current_timestamp






		СВЯЗИ
		Внешний ключ - нужен для целостности данных, для связей на уровне базы. Облегчают работу.
		"Физическая связь" - связь между двумя таблицами. Есть родительская таблица и есть дочерняя таблица.
		В зависимости как мы настроили внешний ключ, мы можем изменить данные в дочерней талице.
		Например user.id будет связан с post.author_id .
		Можно уже на уровне базы, используя внешний ключ, не разрешать удалять пользователя, если он привязан к посту.
		Переходим в дочернюю таблицу post->структура->связи.
		И задаем ограничения, что делать при удалении, что делать при изменении:
		cascade		- каскадное обновление, если мы изменим id пользователя на 22, то и author_id автоматически измениться на 22
					  при удалении родителя, удаляться и дочерние данные.
		set null	- установить в поле null, (должна быть устновлена галочка null на поле)
		no action	- ничего не делать
		restrict	- нельзя удалить/изменить из родительской талицы связанное поле (уже на уровне базы не даст удалить связанное поле)

		Все зависит от того что нужно делать.
		Если нужно обновлять данные - cascade.
		Если нужно сохранить данные - restrict (в этом случае добавляем поле статус).
		Если все равно - set null.
		Мы же в блоге будем все делать "cascade".


		Cвязи:
		POST.author_id 		- USER.id
		POST.category_id 	- CATEGORY.id
		CATEGORY.parent_id 	- CATEGORY.id (Если версия phpmyadmin позволяет создать внутренюю связь, связываем.
										   Необязательно. Установить тип связи (каскадность) не получится)
		COMMENT.post_id 	- POST.id
		COMMENT.author_id 	- USER.id

		БД->Вкладка дизайнер: можно посмотреть связи таблиц


		Есть еще "логическая связь" помимо физической:
		1) один к одному - комментарий к автору
		2) один ко многим - автор к комментраиям
		3) многие ко многим
		Нужно изучить!!!





*/echo 'zreadme.php';

