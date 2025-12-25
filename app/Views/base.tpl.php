<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url('/css/app.css') ?>">
    <link rel="stylesheet" href="<?= base_url('/css/charts.min.css') ?>">
    <script src="<?= base_url('/js/jquery.slim.min.js') ?>"></script>
    <script src="<?= base_url('/js/bootstrap.bundle.min.js') ?>"></script>

    <title>changeme</title>
</head>

<body data-bs-theme="dark">
    <nav class="navbar navbar-expand-lg bg-body-tertiary shadow">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <span class="fw-bold h4">Change</span>Me
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">

                    <li class="nav-item">
                        <a class="nav-link text-light" href="<?= url_to('Home::index') ?>">Dashboard</a>
                    </li>

                </ul>
            </div>
        </div>
    </nav>
    <div class="mt-3 container-fluid">
        <?php if (session()->getFlashdata('error') != ''): ?>
            <div class="alert alert-danger">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('success') != ''): ?>
            <div class="alert alert-success">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>
        <?= $this->renderSection('content') ?>
    </div>

    <script src="<?= base_url('/js/app.js') ?>"></script>
</body>

</html>