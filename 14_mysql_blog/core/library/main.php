<?

function show404page()
{
	header("HTTP/1.1 404 Not Found");
	//todo заменить на view
	echo '404 page';
}


function renderView($viewName, $formErrors = [])
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