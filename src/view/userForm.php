<!-- use like a template for delete forms -->
<aside>
    <h2><?=$title; ?></h2>
    <?=isset($text) ? $text : ""; ?>
    <?=isset($msgSuccess) ? die("<div class='alert alert-success'>".$msgSuccess."</div>") : ""; ?> <!-- success message -->
    <?=(isset($msgError)) ? die("<div class='alert alert-danger'>".$msgError)."</div>" : ""; ?> <!-- form errors -->
    <?=(isset($errorList)) ? die("<div class='alert alert-danger'>".implode("<br>",$errorList)."</div>") : ""; ?> <!-- form errors -->
    <?=($messageList->isEmpty()) ? "" : die($messageList->getAllHTML()); ?> <!-- form errors (poo method) -->
    <?=isset($form) ? $form->display() : "" ?>
</aside>
