<aside>
    <h2>Supprimer un album</h2>
    <?=(isset($errorList)) ? "<div class='alert alert-danger'>$errorList</div>" : ""; ?> <!-- form errors -->
    <?=$formDeleteAlbum->display(); ?>
</aside>