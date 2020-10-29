<?
function findCategoryById($id)
{
	$sql = "SELECT * FROM category WHERE id =" . $id;
	return selectData($sql);
}

function saveNewCategory($data)
{
	$sql = "INSERT INTO category (title,parent_id) VALUES ('{$data['title']}','{$data['parent_id']}')";
	return insertUpdateDelete($sql);
}