<!-- use like a template for delete forms -->
<aside>
    <h2><?=$title; ?></h2>
    <?=isset($msgSuccess) ? die("<div class='alert alert-success'>".$msgSuccess."</div>") : ""; ?> <!-- success message -->
    <?=(isset($msgError)) ? die("<div class='alert alert-danger'>".$msgError) : ""; ?> <!-- form errors -->
    <?=(isset($errorList)) ? die("<div class='alert alert-danger'>".implode("<br>",$errorList)."</div>") : ""; ?> <!-- form errors -->
    <?=$form->display(); ?>
</aside>
