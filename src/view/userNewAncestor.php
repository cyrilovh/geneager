<aside>
    <?=isset($errorList) ? "<div class='alert alert-danger'>".$errorList."</div>" : ""; ?>
    <?=isset($successMsg) ? "<div class='alert alert-success'>".$successMsg."</div>" : ""; ?>
    <?=isset($warningMsg) ? "<div class='alert alert-warning'>".$warningMsg."</div>" : ""; ?>
    <?=$ancestorForm->display(); ?>
</aside>