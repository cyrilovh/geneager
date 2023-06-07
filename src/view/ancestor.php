<?php
    namespace class;
?>
<aside>
    <!-- IDENTITY, GENDER, SUMMARY -->
    <div class="ancestorBio">
        <?=(userInfo::isAuthorOrAdmin($ancestor->get()["id"])) ? "<p class='bar'><a href='/userEditAncestor/".$ancestor->get()["id"]."' class='btn btn-info btn-sm'><i class='fas fa-edit'></i> Modifier</a> <a href='/userDeleteAncestor/".$ancestor->get()["id"]."' class='btn btn-danger btn-sm'><i class='fas fa-trash'></i> Supprimer</a></p>" : ""; ?>
        <img class="picture" src="<?=($ancestor->get()["photo"]) ? "/picture/ancestor/".$ancestor->get()["photo"]: DEFAULTPICTUREANCESTOR ;?>" onerror="this.src='<?=DEFAULTPICTUREANCESTOR;?>'" alt="" title="">
        <h1><?=$ancestor->getFullIdentity(true); ?></h1>
        <p class="txt-disabled"><i class="fas fa-venus-mars"></i> <?=display::gender($ancestor->get()["gender"])?></p>
        <h2>Biographie:</h2>
        <p class="biography"><?=(strlen(format::normalize($ancestor->get()["biography"]))>0) ? $ancestor->get()["biography"]: "Aucune biographie pour cet individu."; ?></p>
    </div>
    <!-- Timeline -->
    <!-- créer class getTimeline() -->
    <div class="ancestorTimeline">
        <p><i class="fas fa-baby-carriage"></i> 01/01/1900 &mdash; Paris, France</p>
        <ul class="timeline">
            <li class="union">1922 &mdash; Mariage avec <a href=''><span class="capitale">marie</span> <span class="uppercase">dufour</span></a></li>
            <li class="picture">1926 &mdash; Photo &mdash; Paris</li>
            <li class="home">1935 &mdash; Créteil</li>
            <li class="location">1944-1945 &mdash; Prison du mans</li>
        </ul>
        <p><i class="fas fa-cross"></i> 01/01/1990 &mdash; Paris, France</p>
    </div>
    <!-- Family links -->
    <div class="familyLinks">
        <h2>Liens parentés:</h2>
        <div class="label">
            <div class="subLabel">
                <img src="<?=DEFAULTPICTUREANCESTOR;?>" alt="" title="" class="thumb">
            </div>
            <div class="subLabel">
                <div>
                    <a href="/profil.php?id=35"><span class="capitale">marie</span> <span class="uppercase">dufour</span></a>
                </div>
                <div>
                    <p><small>[ &Eacute;pouse ]</small></p>
                </div>
            </div>
        </div>
        <div class="label">
            <div class="subLabel">
                <img src="<?=DEFAULTPICTUREANCESTOR;?>" alt="" title="" class="thumb">
            </div>
            <div class="subLabel">
                <div>
                    <a href="/profil.php?id=35"><span class="capitale">marian</span> <span class="uppercase">dupond</span></a>
                </div>
                <div>
                    <p><small>[ Enfant ]</small></p>
                </div>
            </div>
        </div>
    </div>
    <!-- ARCHIVES -->
    <div class="archiveList">
        <h2>Archives o&ucirc; Pierre est identifié:</h2>

        <div class="label">
            <div class="subLabel">
                <img src="/assets/img/defaultDocument.webp" alt="" title=""/>
            </div>
            <div class="subLabel">
                <div>
                    <a href="/displayArchive/?id=35">Titre du document</a>
                </div>
                <div>
                    <p>Courte description du document.</p>
                    <p><small><i class="fa-solid fa-link"></i>  Archives du Nord - Côte ...</small></p>
                </div>
            </div>
        </div>

        <div class="label">
            <div class="subLabel">
                <img src="/assets/img/defaultDocument.webp" alt="" title=""/>
            </div>
            <div class="subLabel">
                <div>
                    <a href="/displayArchive/?id=35">Titre du document</a>
                </div>
                <div>
                    <p>Courte description du document.</p>
                    <p><small><i class="fa-solid fa-link"></i>  Archives du Nord - Côte ...</small></p>
                </div>
            </div>
        </div>
        
    </div>
    <!-- Pictures where the person is identified -->
    <div class="pictureList">
        <h2>Photos o&ucirc; Pierre est identifié:</h2>

        <div class="label">
            <div class="subLabel">
                <img src="/assets/img/defaultPicture.webp" alt="" title=""/>
            </div>
            <div class="subLabel">
                <div>
                    <a href="/displayArchive/?id=35">Photo de famille</a>
                </div>
                <div>
                    <p>Courte description de la photo.</p>
                    <p><small><i class="fa-solid fa-location-dot"></i> Paris</small></p>
                    <p><small><i class="fa-solid fa-calendar-days"></i> 1926</small></p>
                </div>
            </div>
        </div>

        <div class="label">
            <div class="subLabel">
                <img src="/assets/img/defaultPicture.webp" alt="" title=""/>
            </div>
            <div class="subLabel">
                <div>
                    <a href="/displayArchive/?id=35">Photo de famille</a>
                </div>
                <div>
                    <p>Courte description de la photo</p>
                    <p><small><i class="fa-solid fa-link"></i> example.org</small></p>
                </div>
            </div>
        </div>

    </div>
</aside>