<aside>
<div class="bar">
        <a href='/userAlbumList' class="btn btn-info"><i class="fas fa-images"></i> Albums</a>
    </div>
    <h2>Nouvel album</h2>
    <!-- messages -->
    <?=(isset($errorList)) ? "<div class='alert alert-danger'>$errorList</div>" : ""; ?>
    <?=(isset($successMessage)) ? "<div class='alert alert-success'>$successMessage</div>" : ""; ?>
    <div class='alert alert-info'>L'image de couverture est automatiquement sélectionnée (la dernière).</div>
    <!-- form -->
    <?=$formNewAlbum->display(); ?>
</aside>