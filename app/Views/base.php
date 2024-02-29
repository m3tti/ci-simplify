<?php

/**
 * @var \CodeIgniter\View\View $this
 */
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?= $this->renderSection('title') ?></title>
	<link rel="stylesheet" href="<?= base_url('css/tachyons.min.css') ?>">
	<script src="<?= base_url('js/alpine.min.js') ?>"></script>
	<script src="<?= base_url('js/htmx.min.js') ?>"></script>
</head>

<body hx-boost="true" class="helvetica">
	<?= $this->renderSection('content') ?>
</body>

</html>