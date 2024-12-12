<?php
/**
 * @var \CodeIgniter\View\View $this
 */
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url('img/favicon-32x32.png') ?>">
    <link rel="manifest" href="<?= base_url('manifest.json') ?>" />
    <link rel="stylesheet" href="<?= base_url('css/app.css') ?>">
    <script>
        var base_url = "<?= base_url('') ?>";
    </script>
    <title><?= $this->renderSection('title') ?></title>
</head>
<body class="bg-body-tertiary">
    <iframe hidden name=htmz onload="setTimeout(()=>document.querySelector(contentWindow.location.hash||null)?.replaceWith(...contentDocument.body.childNodes))"></iframe>

    <nav id="navbar" class="z-1 navbar navbar-expand-lg position-fixed bg-body-tertiary w-100 top-0">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold fs-4" href="<?= url_to('Home::index') ?>">
                My<span class="fw-bold">App</span>
            </a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <?php if(auth()->user()): ?>
                        <li class="nav-item">
                            <a class="nav-link mt-2 mt-lg-0" href="<?= url_to('Home::admin') ?>">
                                Admin
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mt-2 mt-lg-0" href="<?= url_to('\CodeIgniter\Shield\Controllers\LoginController::logoutAction') ?>">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0z"/>
                                    <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z"/>
                                </svg> Logout
                            </a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link mt-2 mt-lg-0" href="<?= url_to('\CodeIgniter\Shield\Controllers\LoginController::loginView') ?>">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-in-left" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M10 3.5a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-2a.5.5 0 0 1 1 0v2A1.5 1.5 0 0 1 9.5 14h-8A1.5 1.5 0 0 1 0 12.5v-9A1.5 1.5 0 0 1 1.5 2h8A1.5 1.5 0 0 1 11 3.5v2a.5.5 0 0 1-1 0z"/>
                                    <path fill-rule="evenodd" d="M4.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H14.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708z"/>
                                </svg> Login
                            </a>
                        </li>
                    <?php endif ?>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5 pt-3 pt-lg-5 fadeIn">
        <?php if(session()->getFlashdata('error') != ''): ?>
        <div class="alert alert-danger">
            <?= session()->getFlashdata('error') ?>
        </div>
        <?php endif; ?>
        <?php if(session()->getFlashdata('success') != ''): ?>
        <div class="alert alert-success">
            <?= session()->getFlashdata('success') ?>
        </div>
        <?php endif; ?>
        <?= $this->renderSection('content') ?>
    </div>

    <?= $this->renderSection('free-content') ?>
    <div class="pb-5 mb-lg-0 pb-lg-0 <?= url_is('/') ? 'bg-black' : '' ?>">
        <div class="pb-5"></div>
    </div>

    <div id="footer" class="d-lg-none position-fixed w-100 bottom-0 d-flex justify-content-center z-3 mb-2">
        <div class="shadow-lg bg-black mx-5 my-2 py-2 px-2 d-flex rounded-5">
            <div class="mx-1 btn btn-success rounded-5 fs-3">
                <a class="text-black text-decoration-none mb-1" href="<?= url_to('JobController::selectNew') ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                        <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>
    
    <script src="<?= base_url('js/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?= base_url('js/jquery-3.7.1.min.js') ?>"></script>
    <script src="<?= base_url('js/sw_register.js') ?>"></script>
    <script src="<?= base_url('js/app.js') ?>"></script>
    <?= $this->renderSection('scripts') ?>
</body>
</html>