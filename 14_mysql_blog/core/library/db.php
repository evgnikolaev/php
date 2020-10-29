<? //ф-ии для работы с бд


function connectToDb()
{
	$config = require 'core/config/db.php';

	$link = @mysqli_connect($config['host'], $config['user'], $config['password'], $config['db_name']);
	if (!$link) {
		die('DB connection error! Error code - ' . mysqli_connect_errno() . ' . Error message - ' . mysqli_connect_error());
	}
	mysqli_set_charset($link, 'utf8');
	return $link;
}


function selectData($sql)
{
	$link = connectToDb();
	$res = mysqli_query($link, $sql);
	if (!$res) {
		die(mysqli_errno($link) . ' --- ' . mysqli_error($link));
	}
	return $res;
}


function insertUpdateDelete($sql)
{
	$link = connectToDb();
	$res = mysqli_query($link, $sql);
	if (!$res) {
		die(mysqli_errno($link) . ' --- ' . mysqli_error($link));
	}
	return mysqli_insert_id($link);//вернем id результата, $res - возвращает кол-во записей.
}


function getSaveData($str)
{
	$link = connectToDb();
	// все спецсимволы будут заэкранированы
	return mysqli_escape_string($link, $str);
}


function getAll($table)
{
	$sql = "SELECT * FROM $table WHERE 1";
	return mysqli_fetch_all(selectData($sql), MYSQLI_ASSOC);
}