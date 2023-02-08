<aside>
    <h2>Photos de famille:</h2>
    <p>
        <?=$gng_paramList->get("albumListSummary", true); ?> 
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
        <?= (class\userInfo::isConnected()) ? "<p class='bar'><a class='btn btn-outline-success btn-sm' href='/userNewAlbum'><i class='fa-solid fa-plus'></i> Nouvel album</a></p>" : "" ?>
    <!-- END BUTTONS-->

    <!-- START LIST -->
    <div class="albumList">
    <?=$output;?>
    </div>
    <!-- END LIST -->
</aside>
<?=class\paging::gen($pageCount, $page); ?>