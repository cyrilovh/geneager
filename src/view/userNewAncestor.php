<aside>
    <?=isset($errorList) ? "<div class='alert alert-danger'>".$errorList."</div>" : ""; ?>
    <?=$ancestorForm->display(); ?>
</aside>