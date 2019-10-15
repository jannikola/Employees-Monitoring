<?php

$title = isset($title) ? $title : '';
?>

<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title" id="eprotocolLabel"><?= $title ?></h4>
</div>

<div class="modal-body">
    <?= $content ?>
</div>

<?php if (!empty($footer)): ?>
    <div class="modal-footer">
        <?= $footer ?>
    </div>
<?php endif; ?>
