<?
$allCategory = getAll('category');
?>
	<form action="" method="POST">
		<input type="text" name="title" placeholder="title">
		<p>
			<select name="parent_id">
				<option value="0" selected>no parent</option>
				<?
				if (!empty($allCategory)) {
					foreach ($allCategory as $cat) {
						?>
						<option value="<?= $cat['id'] ?>"><?= $cat['title'] ?></option>
						<?
					}
				}
				?>
			</select>
		</p>
		<button>create</button>
	</form>
<?