<aside>
    <h2>Photos de famille:</h2>
    <p><?=$gng_paramList->get("pictureListSummary"); ?> <span class="btn btn-outline-info btn-sm"><i class="fa-solid fa-pen"></i></span></p>
    <!-- START LIST -->
    <div class="pictureList">
    <?php

        use class\display;

        foreach($albumList as $album){ 

    ?>
        <div class="label">
            <div class="cover"></div>
            <div class="subLabel detail">
                <a class="title" href="/displayArchive/?id=35"><?=$album["title"]; ?></a>
                <p><?=(strlen($album["descript"])>0) ? $album["descript"] : "Aucune description."; ?></p>
                <p class="author"><i class="fa fa-user" aria-hidden="true"></i> geneager</p>
                <p class="bar"><span class="btn btn-outline-info btn-sm"><i class="fa-solid fa-pen"></i></span></p>
            </div>
        </div>
    <?php
        }
    ?>
    </div>
    <!-- END LIST -->
</aside>