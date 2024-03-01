<?php

/**
 * @var \CodeIgniter\View\View $this
 */
?>
<button onclick="document.getElementById('<?= $id ?>').showModal()" class="w-100 b ttu bn pa3 bg-dark-red white ">Delete</button>
<dialog id="<?= $id ?>">
	<form action="<?= url_to($action) ?>" method="post">
		<?= csrf_field() ?>
		<input type="hidden" name="id" value="<?= $model_id ?>">

		<a href="#" onclick="document.getElementById('<?= $id ?>').close()">Cancel</a>
		<input type="submit" value="Delete">
	</form>
</dialog>