<? //посты

function findPostById($id)
{
	$sql = "SELECT id FROM post WHERE id =" . $id;
	return selectData($sql);
}


function getAllPostInCategory($catId)
{
	$sql = "SELECT id FROM post WHERE category_id=" . $catId;
	$result = selectData($sql);
	if ($result->num_rows > 0) {
		$allPosts = mysqli_fetch_all($result, MYSQLI_ASSOC);
		return $allPosts;
	} else {
		return [];
	}
}


function getAllPostFromAuthor($authorId)
{
	$sql = "SELECT id FROM post WHERE author_id=" . $authorId;
	return selectData($sql);
}