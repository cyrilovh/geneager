<aside>
    <h2>Supprimer une photo d'un ancêtre</h2>
    <?=isset($msgSuccess) ? die("<div class='alert alert-success'>".$msgSuccess."</div>") : ""; ?> <!-- success message -->
    <?=(isset($errorList)) ? die("<div class='alert alert-danger'>".implode("<br>",$errorList)."</div>") : ""; ?> <!-- form errors -->
    <?=$formDeleteAncestorPicture->display(); ?>
</aside>