<aside>
    <h2>Supprimer un album</h2>
    <?=isset($msgSuccess) ? "<div class='alert alert-success'>".$msgSuccess."</div>" : ""; ?> <!-- success message -->
    <?=(isset($errorList)) ? "<div class='alert alert-danger'>".implode("<br>",$errorList)."</div>" : ""; ?> <!-- form errors -->
    <?=$formDeleteAlbum->display(); ?>
</aside>