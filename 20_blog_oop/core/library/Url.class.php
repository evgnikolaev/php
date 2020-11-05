<? /*
чертеж - что мы можем делать с урл:

*/

namespace library;

class Url
{

	protected static function getSegmentsFromUrl()
	{
		$segments = explode('/', $_GET['url']);
		if (empty($segments[count($segments) - 1])) {
			unset($segments[count($segments) - 1]);
		}

		//убираем спецсимволы в урл
		$segments = array_map(function ($v) {
			return preg_replace('/[\\*\']/', '', $v);
		}, $segments);


		return $segments;
	}


	static function getParam($paramName)
	{
		return $_GET[$paramName];
	}


	static function getSegment($n)
	{
		$segments = self::getSegmentsFromUrl();
		return $segments[$n];
	}


	static function getAllSegment()
	{
		return self::getSegmentsFromUrl();
	}

}
