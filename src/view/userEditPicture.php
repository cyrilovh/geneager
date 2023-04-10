<aside>
    <h3>&Eacute;diter une photo</h3>
    <p class="bar"><a href='/pictureDetail/<?=$pictureData["filename"];?>' class='btn btn-primary btn-sm'><span class='fas fa-eye'></span> Voir le détail</a></p>
    <?=(isset($msgError) ? "<div class='alert alert-danger'>$msgError</div>" : ""); ?>
    <?=(isset($msgSuccess) ? die("<div class='alert alert-success'>$msgSuccess</div>") : ""); ?>
    <?=isset($adminForm) ? $adminForm->display() : ""?>
    <?= isset($form) ? $form->display() : ""; ?>
</aside>