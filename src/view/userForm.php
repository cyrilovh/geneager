<!-- use like a template for delete forms -->
<aside>
    <h2><?=$title; ?></h2>
    <?=isset($text) ? $text : ""; ?>
    <?=isset($msgSuccess) ? die("<div class='alert alert-success'>".$msgSuccess."</div>") : ""; ?> <!-- success message : this method will be deprecated (will be replaced by poo method) -->
    <?=(isset($msgError)) ? die("<div class='alert alert-danger'>".$msgError)."</div>" : ""; ?> <!-- form errors : this method will be deprecated (will be replaced by poo method) -->
    <?=(isset($errorList)) ? die("<div class='alert alert-danger'>".implode("<br>",$errorList)."</div>") : ""; ?> <!-- form errors : this method will be deprecated (will be replaced by poo method) -->
    <?=($messageList->isEmpty()) ? "" : die($messageList->getAllHTML()); ?> <!-- form errors (poo method) -->
    <?=isset($form) ? $form->display() : "" ?>
</aside>
