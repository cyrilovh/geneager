<aside>
    <h1><?=$title; ?></h1>
    <?=(isset($SQLdata["id"]) ? "<p><a href='/ancestor/".$SQLdata["id"]."' class='btn btn-info btn-sm'><span class='fas fa-eye'></span> Voir la fiche</a> <a href='/userEditAncestorLink/".$SQLdata["id"]."' class='btn btn-info btn-sm'><span class='fas fa-sitemap'></span> &Eacute;diter les liens familiaux</a> <a href='/userDeleteAncestor/".$SQLdata["id"]."' class='btn btn-danger btn-sm'><span class='fas fa-trash'></span> Supprimer l'ancêtre</a></p>" : ""); ?>
    <?=isset($errorList) ? "<div class='alert alert-danger'>".$errorList."</div>" : ""; ?>
    <?=isset($successMsg) ? die("<div class='alert alert-success'>".$successMsg."</div>") : ""; ?>
    <?=isset($warningMsg) ? "<div class='alert alert-warning'>".$warningMsg."</div>" : ""; ?>
    <?=$ancestorForm->display(); ?>
</aside>