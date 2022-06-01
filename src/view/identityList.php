<aside>
    <h2>Liste des fiches d'identités:</h2>
    <div>
        Trier par 
        <select name="orderBy" class="filter">
            <?php
                foreach(enumList\OrderBy::array() as $key => $value){
                    echo "<option value='$key'>$value</option>";
                }
            ?>
        </select> (du plus récent au moins récent)
    </div>

    <div class="ancestorList">
        <?php

        use class\display;

        foreach($ancestorList as $ancestor){ 
        
        ?>
        <!-- str label -->
            <div class="ancestorLabel">
                <div class="photo">
                    <a href='/ancestor/?id=1'><img loading="lazy" src="<?=($ancestor["photo"]) ? "/ressources/ancestorProfilePicture/".$ancestor["photo"]: "/assets/img/unknownAncestor.webp" ;?>" onerror="this.src='/assets/img/unknownAncestor.webp'" alt="" title=""></a>
                </div>
                <div class="details">
                    <p class='identite'><a href='/ancestor/?id=<?=($ancestor["id"]); ?>'><?=display::truncateIdentity($ancestor["firstNameList"], $ancestor["lastName"], $ancestor["maidenName"]); ?><span class='capitale'></span> <span class='uppercase'></span></a></p>
                   <?=(!is_null($ancestor["birthDay"]) ? ' <p class="dates">Né(e) en '.class\format::date($ancestor["birthDay"],"Y").'</p>' : ""); ?>
                    <p class='genre'>Genre: <?=display::gender($ancestor["gender"]); ?></p>
                </div>
            </div>
            <!-- end label -->
        <?php 
        } 
        ?>
    </div>
</aside>
<div class="paging">
    Pages:
    <?php
        for($i=1; $i<=$pageCount; $i++){
            $active = ($i==$page) ? "active" : "";
            $cleanParameters = class\url::removeParam($_SERVER["REQUEST_URI"], "page");
            echo "<a href='{$cleanParameters}&page=$i' class='$active'>".$i."</a>";
        }
    ?>
</div>