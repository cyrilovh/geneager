<aside>
    <p><?=$gng_paramList->get("homeSummary"); ?> <span class="btn btn-outline-info btn-sm"><i class="fa-solid fa-pen"></i></span></p>
    <h2>Dernières fiches mises à jour:</h2>
    <div class="ancestorList">
        <?php

        use class\display;

        foreach($ancestorList as $ancestor){ ?>
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
        <?php } ?>
    </div>
</aside>