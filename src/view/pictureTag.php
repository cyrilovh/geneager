<img src="/picture/family/<?=$picture['filename'];?>" title="<?=$picture['title']; ?>" id="picture" usemap="#workmap" />
<div class="popup addTag">
    <div class="window addTag">
        <h1>Ajouter un individu:</h1>
        <div class="alert alert-danger"></div>
        <div class="alert alert-info"></div>

        <p>Coordonnées:<br><input type="text" id="coordonnees" pattern="\d{1,5},\d{1,5},\d{1,5},\d{1,5}" class="field-disabled"></p>
        <div>
            <p>Individu:</p>
            <div class="inputLabel" id="inputLabel">
                <img src="<?=DEFAULTPICTUREANCESTOR; ?>" id="pictureAncestor" />
                <span class="label"></span>
                <input type="number" class="data" required/> 
                <input type="text" id="search" autocomplete="off"/>
            </div>

            <div class="suggestionList" data-idAttachment="inputLabel">

                <!-- <div class="item" data-data="1">
                    <img src="<?=DEFAULTPICTUREANCESTOR; ?>" class="thumbnail" />
                    <div class="label">
                        <div class="identity text">Identité 1</div>
                        <div class="dates">1900-1959</div>
                    </div>
                </div>

                <div class="item" data-data="2">
                    <img src="<?=DEFAULTPICTUREANCESTOR; ?>" class="thumbnail" />
                    <div class="label">
                        <div class="identity text">Identité 2</div>
                        <div class="dates">1910-1968</div>
                    </div>
                </div>
                -->

            </div>
        </div>
        <p class="mt10 float-right"><button class="btn btn-danger" onclick="closeMessage();"><i class="fa-solid fa-circle-xmark"></i> Fermer</button> <button class="btn btn-success submit" onclick="addTag();"><i class="fa-solid fa-check"></i> Ajouter</button></p>

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
