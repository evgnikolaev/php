<?

namespace library;

class Request
{
	static public function isPost()
	{
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			return true;
		}
		return false;
	}

	static public function getPost()
	{
		return $_POST;
	}
}