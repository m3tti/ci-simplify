<input id="<?= $id ?>Submit" class="btn btn-<?= $severity ?>" type="submit" value="<?= $text ?>">
<span id="<?= $id ?>Load" class="btn btn-secondary d-none d-flex align-items-center justify-content-center">
    <div class="loader me-2"></div>
    <div>
        Loading...
    </div>
</span>

<?= $this->section('scripts') ?>
<script>
    $("<?= $formId ?>").submit(function(e) {
    $("#<?= $id ?>Load").removeClass('d-none');
    $("#<?= $id ?>Submit").addClass('d-none');
    })
</script>
<?= $this->endSection() ?>