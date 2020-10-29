<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title><?= $data['categoryData']['title']; ?></title>
</head>
<body>
<?
if (!empty($data['posts'])) {
	foreach ($data['post'] as $post) {
		echo "<pre>";
		print_r($post);
		echo "</pre>";
	}
} else {
	echo 'Ни одного поста не найдено';
} ?>
</body>
</html>