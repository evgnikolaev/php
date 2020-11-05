<?

namespace models;

use base\BaseForm;
use library\Auth;

class PostForm extends BaseForm
{
	public $id;
	public $title;
	public $content;
	protected $_tableName = 'post';


	function getRules()
	{
		return [
			'title'   => ['required', 'unique'],
			'content' => ['required']
		];
	}


	function save()
	{
		$author_id = Auth::getUserId();
		$sql = "INSERT INTO {$this->_tableName} (title, content, author_id) VALUES ('{$this->title}','{$this->content}'),{$author_id}";
		$res = $this->_db->sendQuery($sql);
		if (!$res) {
			$this->_errors['save_model'] = 'Error save post';
			return false;
		}
		$this->id = $this->_db->getLastInsertId();
		return true;
	}


	function update()
	{
		$sql = "UPDATE {$this->_tableName}  SET title='{$this->title}' , content='{$this->content}' WHERE id={$this->id}";
		$res = $this->_db->sendQuery($sql);
		if (!$res) {
			$this->_errors['update_model'] = 'Error update post';
			return false;
		}
		return true;
	}


	function delete()
	{
		$sql = "DELETE FROM {$this->_tableName}  WHERE id={$this->id}";
		$res = $this->_db->sendQuery($sql);
		if (!$res) {
			$this->_errors['delete_model'] = 'Error delete post';
			return false;
		}
		return true;
	}

}