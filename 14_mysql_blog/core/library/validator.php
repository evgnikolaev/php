<?
//задаем наборы функций-правил с префиксом, чтобы не было конфликтов в названии
function required($data)
{
	return !empty($data);
}

function login($data)
{
	return true;
}

function password($data)
{
	return true;
}

function email($data)
{
	return true;
}

/* основная ф-ия
	validateForm([
				'login'    => ['required'],
				'password' => ['required'],
				'email'    => ['required', 'email'],
	], $_POST);
*/
function validateForm($dataWithRules, $filteredData)
{
	$errorForms = [];

	$fields = array_keys($dataWithRules); //получаю имена полей

	foreach ($fields as $fieldName) {
		$filedData = $filteredData[$fieldName]; // Значение поля, которое ввел пользователь
		$rules = $dataWithRules[$fieldName]; //свод правил, например - ['required', 'email']

		foreach ($rules as $ruleName) {
			if (!$ruleName($filedData)) {
				$errorForms[$fieldName][] = $ruleName;
			}
		}
	}

	return $errorForms;
}