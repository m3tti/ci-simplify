<?php

/**
 * @var \CodeIgniter\View\View $this
 */
?>
<a onclick="document.getElementById('<?= $id ?>').showModal()" class="link dark-red bg-white hover-white hover-bg-dark-red b pa2 ba bw1 b--dark-red">Delete</a>
<dialog id="<?= $id ?>">
	<form action="<?= url_to($action) ?>" method="post">
		<?= csrf_field() ?>
		<input type="hidden" name="id" value="<?= $model_id ?>">

		<?php if (isset($extraFields)) : ?>
			<?php foreach ($extraFields as $key => $value) : ?>
				<input type="hidden" name="<?= $key ?>" value="<?= $value ?>">
			<?php endforeach ?>
		<?php endif ?>

		<a href="#" onclick="document.getElementById('<?= $id ?>').close()">Cancel</a>
		<input type="submit" value="Delete">
	</form>
</dialog>