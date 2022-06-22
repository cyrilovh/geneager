<nav class="topnav">
    <a href="/" class="active"><i class="fas fa-home"></i></a>
    <div class="links">
        <i class="far fa-times-circle"></i>
        <div class="links2">
            <a href="/identityList"><i class="far fa-id-card"></i><span class="txt"> Carte d'identité</span></a>
            <a href="/albumList"><i class="fas fa-camera"></i><span class="txt"> Photos</span></a>
            <a href="/archivesList"><i class="fas fa-landmark"></i><span class="txt"> Archives</span></a>
            <a href="/videoList"><i class="fas fa-film"></i><span class="txt"> Vidéos</span></a>
            <a href="/tree"><i class="fas fa-sitemap"></i><span class="txt"> Arbre</span></a>
            <!-- str dropdown -->
            <div class="dropdown">
                <button class="dropbtn"><i class="far fa-user"></i> Mon compte</button>
                <div class="dropdown-content">
                    <?php if(isset($_SESSION["username"])){ ?>
                    <a href="/userPanel">Administration</a>
                    <a href="/logout">Déconnexion</a>
                    <?php }else{ ?>
                        <a href="/login">Connexion</a>
                    <?php } ?>
                </div>
            </div>
            <!-- end dropdown -->
        </div>
    </div>
    
    <div class="search">
        <i class="fas fa-search"></i><input type="search" value="" required minlength="2" maxlength="100" autocomplete="off"/>
    </div>
    <i class="fa fa-bars"></i>
</nav>