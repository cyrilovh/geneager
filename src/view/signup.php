<!-- use like a template for delete forms -->
<aside>
    <h2><?=$title; ?></h2>
    <?=isset($msgSuccess) ? die("<div class='alert alert-success'>".$msgSuccess."</div>") : ""; ?> <!-- success message -->
    <?=(isset($msgError)) ? "<div class='alert alert-danger'>".$msgError."</div>" : ""; ?> <!-- form errors -->
    <?=(isset($errorList)) ? (!empty($errorList) ? "<div class='alert alert-danger'>b: ".implode("<br>",$errorList)."</div>" : "") : ""; ?> <!-- form errors -->
    <?=$form->display(); ?>
</aside>