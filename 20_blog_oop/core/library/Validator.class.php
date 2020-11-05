<?

namespace library;

class Validator
{
	protected $_errors;
	protected $_rules;
	protected $_fields;
	protected $_data;
	protected $_table = null;


	public function __construct($data, $rules)
	{
		$this->_rules = $rules;
		$this->_data = $data;
		$this->_fields = array_keys($rules);
	}


	public function validateThis()
	{
		$errorForms = [];

		foreach ($this->_rules as $field => $rules) {
			foreach ($rules as $rule) {
				if (method_exists($this, $rule)) {
					if (is_null($this->getError($field))) {
						$this->$rule($field);
					}
				} else {
					throw  new \Exception('unknow validaton rule' . $rule);
				}
			}
		}

		if (!empty($this->_errors)) {
			return false;
		}
		return true;
	}


	protected function required($field)
	{
		if (empty($this->_data[$field])) {
			$this->addError($field, 'field must be required');
		}
	}

	protected function email($field)
	{
		$pattern = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i";
		if (!preg_match($pattern, $this->_data[$field])) {
			$this->addError($field, 'email wrong');
		}
	}


	protected function unique($field)
	{
		$sql = "SELECT * FROM {$this->_table} WHERE {$field} = '{$this->_data[$field]}'";
		$res = Db::getDb()->sendQuery($sql);
		if ($res->num_rows > 0) {
			$this->addError($field, 'не уникально');
		}
	}


	protected function confirm($field)
	{
		if ($this->_data[$field] != $this->_data[$field . '_confirm']) {
			$this->addError($field, $field . ' не совпадает с ' . $field . '_confirm');
		}
	}


	public function addError($field, $error)
	{
		$this->_errors[$field] = $error;
	}

	public function getError($field)
	{
		return $this->_errors[$field];
	}

	public function getErrors()
	{
		return $this->_errors;
	}


	public function setTable($tableName)
	{
		$this->_table = $tableName;
	}
}
