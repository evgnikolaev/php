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
	return $res;
}


function getSaveData($str)
{
	$link = connectToDb();
	// все спецсимволы будут заэкранированы
	return mysqli_escape_string($link, $str);
}