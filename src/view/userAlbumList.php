<aside>
    <div class="bar">
        <a href='/userNewAlbum' class="btn btn-success"><i class="fas fa-circle-plus"></i> Nouvel album</a>
    </div>
    
    <div>
        <h2>Liste de mes albums:</h2>
        <!-- START FILTERS-->
        <div class="filterList">
            Trier par 
            <select name="albumOrderBy" class="filter">
                <?php

use class\userInfo;

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
        ajouter system prive public
        <table id="customers">
            <tr>
                <th>Album</th>
                <th>Mise à jour (AMJ)</th>
                <th>Actions</th>
            </tr>
            <?php
                foreach($albumList as $album){
            ?>
            <tr>
                <td>
                    <p class="bold"><?=$album["title"];?></p>
                    <p class="txt-disabled"><?=$album["descript"];?></p>
                     <?=(userInfo::isAdmin()) ? "<p class='txt-disabled italic mt10'><i class='fas fa-user'></i> ".$album["author"] : "";?></p>
                </td>
                <td><?=$album["lastUpdate"];?></td>
                <td><a class="btn btn-outline-info btn-sm" href="/userEditAlbum/?id=<?=$album["id"];?>"><i class="fa-solid fa-pen"></i></a> <a class="btn btn-outline-danger btn-sm" href="/userDeleteAlbum/?id=<?=$album["id"];?>"><i class="fa-solid fa-trash"></i></a> <a href="/displayAlbum.php?id=<?=$album["id"];?>" class="btn btn-outline-primary btn-sm"><i class="fas fa-eye"></i></a></td>
            </tr>
            <?php 
                }
            ?>
        </table>
    </div>

    <?=class\paging::gen($pageCount, $page); ?>
</aside>