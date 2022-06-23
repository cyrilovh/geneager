<aside>
    <h2>Photos de famille:</h2>
    <p>
        <?=$gng_paramList->get("albumListSummary"); ?> 
        <?= (class\userInfo::isAdmin()) ? "<span class='btn btn-outline-info btn-sm'><i class='fa-solid fa-pen'></i></span>" : "" ?>
    </p>
    <!-- START FILTERS-->
    <div class="filterList">
        Trier par 
        <select name="albumOrderBy" class="filter">
            <?php
                foreach(enumList\albumOrderBy::array() as $key => $value){
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
    <!-- END FILTERS-->

    <!-- START BUTTONS-->
    <p class="bar">
        <?= (class\userInfo::isConnected()) ? "<a class='btn btn-outline-success btn-sm' href='/userNewAlbum'><i class='fa-solid fa-pen'></i> Nouvel album</a>" : "" ?>
    </p>
    <!-- END BUTTONS-->

    <!-- START LIST -->
    <div class="albumList">
    <?php
        foreach($albumList as $album){ 

    ?>
        <div class="label">
            <div class="cover"></div>
            <div class="subLabel detail">
                <a class="title" href="/displayAlbum/?id=<?=$album["id"]; ?>"><?=$album["title"]; ?></a>
                <p><?=(strlen($album["descript"])>0) ? class\display::truncateText($album["descript"], 75) : "Aucune description."; ?></p>
                <p class="author"><i class="fa fa-user" aria-hidden="true"></i> <?=$album["author"]; ?></p>
                <?= (class\userInfo::isAuthor($album["author"]) || class\userInfo::isAdmin()) ? "<p class='bar'><span class='btn btn-outline-info btn-sm'><i class='fa-solid fa-pen'></i></span></p>" : ""; ?>
            </div>
        </div>
    <?php
        }
    ?>
    </div>
    <!-- END LIST -->
<!--
 _____        _____ _____ _   _  _____ 
 |  __ \ /\   / ____|_   _| \ | |/ ____|
 | |__) /  \ | |  __  | | |  \| | |  __ 
 |  ___/ /\ \| | |_ | | | | . ` | | |_ |
 | |  / ____ \ |__| |_| |_| |\  | |__| |
 |_| /_/    \_\_____|_____|_| \_|\_____|
                                                                          
-->
    
</aside>