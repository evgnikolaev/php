<?

function show404page()
{
	header("HTTP/1.1 404 Not Found");
	//todo заменить на view
	echo '404 page';
}


function renderView($viewName, array $data = [])
{
	include dirname(__DIR__) . '/views/' . $viewName . '.php';
}


function is_auth()
{
	if (isset($_SESSION['user']['id']) && !empty($_SESSION['user']['id'])) {
		return true;
	}
	return false;
}


function getUrlSegments($num)
{
	$_GET['url'] = str_replace('14_mysql_blog/', '', $_GET['url']);

	$url = strtolower($_GET['url']);
	$urlSegments = explode('/', $url);
	return $urlSegments[$num];
}