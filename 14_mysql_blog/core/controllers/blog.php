<?
//Посты

function action_index()
{
	echo 'action_index';
}

function action_category()
{
	//  Получаем конкретную категорию - /blog/category/4/
	$categoryName = getUrlSegments(2);
	if (is_null($categoryName)) {
		show404page();
	}
	$result = findCategoryById($categoryName);
	if ($result->num_rows == 0) {
		show404page();
	}
	$categoryData = mysqli_fetch_assoc($result);
	$allPosts = getAllPostInCategory($categoryData['id']);
	renderView('category', ['posts' => $allPosts, 'categoryData' => $categoryData]);
}


function action_createCategory()
{
	if (!is_auth()) {
		show404page();
		return false;
	}

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		// валидация и фильтрация
		$catId = saveNewCategory(['title' => $_POST['title'], 'parent_id' => $_POST['parent_id']]);
	}
	renderView('createCategory', []);
}
