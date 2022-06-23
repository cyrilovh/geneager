<aside>
    <div class="bar">
        <a href='/userNewAlbum' class="btn btn-success"><i class="fas fa-circle-plus"></i> Nouvel album</a>
    </div>
    
    <div>
        <h2>Liste de mes photos:</h2>
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
        <table id="customers">
            <tr>
                <th>Image</th>
                <th>Dossier</th>
                <th>Actions</th>
            </tr>
            <?php
                foreach($albumList as $album){
            ?>
            <tr>
                <td>Alfreds Futterkiste</td>
                <td>Maria Anders</td>
                <td><a class="btn btn-outline-info btn-sm" href="/userEditAlbum/?id=<?=$album["id"];?>"><i class="fa-solid fa-pen"></i></a> <a class="btn btn-outline-danger btn-sm" href="/userDeleteAlbum/?id=<?=$album["id"];?>"><i class="fa-solid fa-trash"></i></a></td>
            </tr>
            <?php 
                }
            ?>
        </table>
    </div>

<!--
 _____        _____ _____ _   _  _____ 
 |  __ \ /\   / ____|_   _| \ | |/ ____|
 | |__) /  \ | |  __  | | |  \| | |  __ 
 |  ___/ /\ \| | |_ | | | | . ` | | |_ |
 | |  / ____ \ |__| |_| |_| |\  | |__| |
 |_| /_/    \_\_____|_____|_| \_|\_____|
                                                                          
--
</aside>