<? namespace controllers;

use base\Controller;
use library\Auth;
use library\Request;
use library\Url;
use models\Post;
use models\PostForm;

class ControllerPost extends Controller
{

	function actionIndex()
	{
		echo 'index post';
	}

	function actionView()
	{
		//todo
	}

	function actionCreate()
	{
		if (!Auth::isGuest()) {
			$model = new PostForm();
			if (Request::isPost()) {
				if ($model->load(Request::getPost()) and $model->validate()) {
					if ($model->save()) {
						header('Location: /20_blog_oop/post/view/' . $model->id);
					}
				}
			}

			$this->_view->render('post', ['model' => $model]);
		} else {
			throw new \Exception('Forrbidden', 403);
		}
	}

	function actionEdit()
	{
		if (!Auth::isGuest()) {
			$postId = Url::getSegment(2);
			$post = new Post($postId);

			$model = new PostForm();
			$model->id = $post->id;
			$model->title = $post->title;
			$model->content = $post->content;

			if (Request::isPost()) {
				if ($model->load(Request::getPost()) and $model->validate()) {
					if ($model->update()) {
						header('Location: /20_blog_oop/post/view/' . $model->id);
					}
				}
			}

			$this->_view->render('post', ['model' => $model]);
		} else {
			throw new \Exception('Forrbidden', 403);
		}
	}


	function actionDelete()
	{
		if (!Auth::isGuest()) {
			//todo
		} else {
			throw new \Exception('Forrbidden', 403);
		}
	}
}