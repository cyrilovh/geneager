<aside>
    <h3>&Eacute;diter une photo</h3>
    <?=(isset($msgError) ? "<div class='alert alert-danger'>$msgError</div>" : ""); ?>
    <?=(isset($msgSuccess) ? "<div class='alert alert-success'>$msgSuccess</div>" : ""); ?>
    <?=isset($adminForm) ? $adminForm->display() : ""?>
    <?= isset($form) ? $form->display() : ""; ?>
</aside>