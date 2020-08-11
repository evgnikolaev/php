<?
//  У нас одна точка входа на сайт  . Роутинг происходит при помощи GET паарметра
if (!empty($_GET['page'])) {
	$page = $_GET['page'];
} else {
	$page = 'home';
}


include 'includes/header.php';
if (file_exists('pages/' . $page . '.inc.php')) {
	include 'pages/' . $page . '.inc.php';
} else {
	include 'pages/404.inc.php';
}

include 'includes/footer.php';