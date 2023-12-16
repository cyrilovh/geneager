<aside>
<div class="bar">
        <a href='/albumList' class="btn btn-info"><i class="fas fa-images"></i> Albums</a>
    </div>
    <h2><?=$title; ?></h2>
    <!-- messages -->
    <?=(isset($errorList)) ? "<div class='alert alert-danger'>$errorList</div>" : ""; ?> <!-- form errors -->
    <?=$messageList->getErrorHTML(); ?><!-- create album errors -->
    <?=$messageList->isEmptySuccess() ? "" : die($messageList->getSuccessHTML()); ?> <!-- create album success -->
    <?=$messageList->getInfoHTML(); ?> <!-- create album infos -->
    <!-- form -->
    <?=$formNewAlbum->display(); ?>
</aside>