<aside>
    <h2>Ajouter une photo</h2>
    <p><i class="fas fa-folder"></i> <?=$albumData["title"]; ?></p>
    <?=(isset($errorList)) ? "<div class='alert alert-danger'>$errorList</div>" : ""; ?> <!-- form errors -->
    <?=(isset($successMsg)) ? "<div class='alert alert-success'>$successMsg</div>" : ""; ?> <!-- form success -->
    <?=(isset($warningList)) ? "<div class='alert alert-warning'>$warningList</div>" : ""; ?> <!-- form warning -->
    <?=isset($btnContinue) ? "<p>$btnContinue</p>" : $form->display(); ?> <!-- i display a button for edit picture if the file has been uploaded ELSE i display upload form-->
</aside>
