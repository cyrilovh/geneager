<?=print_r(model\ancestor::suggestByIdentity("pierre")); ?>

<img src="/picture/family/<?=$picture['filename'];?>" title="<?=$picture['title']; ?>" id="picture" usemap="#workmap" />
<div class="popup addTag">
    <div class="window addTagd">
        <h1>Ajouter un individu:</h1>
        <form method="post" action="#">
            <p>Coordonnées:<br><input type="text" id="coordonnees" pattern="\d{1,5},\d{1,5},\d{1,5},\d{1,5}"/></p>
            <div>
                <p>Individu:</p>
                <div class="inputLabel">
                    <img src="<?=DEFAULTPICTUREANCESTOR; ?>" id="pictureAncestor" />
                    <span class="label"></span>
                    <input type="text" id="identity" autocomplete="off" required/>
                </div>
            </div>
            <p class="mt10 float-right"><input type="submit" class="btn btn-success" value="Ajouter" /></p>
        </form>
    </div>
</div>
<div class="popup message">
    <div class="window">
        <h1 class="titre"></h1>
        <p class="message"></p>
        <p class="mt10 float-right"><button class="btn btn-danger" onclick="closeMessage();"><i class="fa-regular fa-circle-xmark"></i> Fermer</button></p>
    </div>
</div>
<?php
    foreach($tagList->getTagList() as $tag){
        $ancestor = $tag->getAncestor()->getFullIdentityDisplayShorter(true);
        $coordinates = $tag->getCoordinates()->getCSS();
        $ancestorID = $tag->getAncestor()->getID();
        echo "
        <div style='$coordinates' class='tag'>
            <div>
                <div>
                    <a href='/ancestor/$ancestorID'><span class='fas fa-eye'></span></a>
                    <a href='/userEditAncestor/$ancestorID'><span class='fas fa-edit'></span></a>
                    <span class='fas fa-trash'></span>
                </div>
                <p>$ancestor</p>
            </div>
        </div>";
    }
?>
