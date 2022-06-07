<aside>
    <h2>Liste des fiches d'identités:</h2>
    <div class="filterList">
        Trier par 
        <select name="ancestorOrderBy" class="filter">
            <?php
                foreach(enumList\ancestorOrderBy::array() as $key => $value){
                    echo "<option value='$key'>$value</option>";
                }
            ?>
        </select>
        Ordre        
        <select name="sortBy" class="filter">
            <?php
                foreach(enumList\sortBy::array() as $key => $value){
                    echo "<option value='$key'>$value</option>";
                }
            ?>
        </select>
    </div>
    <div class="filterList">
        Filtrer genre:
        <select name="gender" class="filter removable">
            <?php
                foreach(enumList\gender::array() as $key => $value){
                    echo "<option value='$key'>".class\format::htmlToUpperFirst($value)."</option>";
                }
            ?>
        </select>
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
<?php
    echo class\paging::gen($pageCount, $page);
?>
