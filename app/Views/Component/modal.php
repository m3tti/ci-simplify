<!-- Button trigger modal -->
<button type="button" class="btn btn-<?= $severity ?>" data-bs-toggle="modal" data-bs-target="#<?= $id ?>">
  <?= $buttonText ?>
</button>

<!-- Modal -->
<div class="modal fade" id="<?= $id ?>" tabindex="-1" aria-labelledby="<?= $id ?>Label" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel"><?= $title ?></h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
		    <?= $body ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Abbrechen</button>
        <form id="<?= $id ?>Form" action="<?= $action ?>" method="post">
          <?= csrf_field() ?>
          <input type="hidden" name="id" value="<?= $model_id ?>">

          <?php if (isset($extraFields)) : ?>
            <?php foreach ($extraFields as $key => $value) : ?>
              <input type="hidden" name="<?= $key ?>" value="<?= $value ?>">
            <?php endforeach ?>
          <?php endif ?>
          <input id="<?= $id ?>Submit" class="btn btn-<?= $severity ?>" type="submit" value="<?= $okText ?>">
          <span id="<?= $id ?>Load" class="btn btn-secondary d-none d-flex align-items-center">
            <div class="loader me-2"></div>
            <div>
              Loading...
            </div>
          </span>
        </form>
      </div>
    </div>
  </div>
</div>

<?php if (isset($longRunning) and $longRunning): ?>
  <?= $this->section('scripts') ?>
    <script>
      $("#<?= $id ?>Form").submit(function(e) {
        $("#<?= $id ?>Load").removeClass('d-none');
        $("#<?= $id ?>Submit").addClass('d-none');
      })
    </script>
  <?= $this->endSection() ?>
<?php endif ?>